<?php

namespace App\Importers;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class Admitad
{
    private static $categories = [];

    private static function download($url, $filename, $command = null, $output = null)
    {
        if (!Storage::delete($filename)) {
            if ($command) $command->error("$filename not deleted!");
            return false;
        }
        if ($command) $command->info("Downloading...");
        if ($output) {
            $bar = $output->createProgressBar(0);
            $bar->setMessage("Downloading");
            $bar->start();
            $res = Http::withOptions([
                'verify' => false,
                'progress' => function (
                    $downloadTotal,
                    $downloadedBytes,
                    $uploadTotal,
                    $uploadedBytes
                ) use ($bar) {
                    if ($bar->getMaxSteps() == 0 && $downloadTotal != 0) {
                        $bar->setMaxSteps($downloadTotal);
                    }
                    $bar->setProgress($downloadedBytes);
                },
            ])->timeout(600)->get($url,);
            $bar->finish();
        } else {
            $res = Http::withOptions([
                'verify' => false,
            ])->timeout(600)->get($url,);
        }

        if ($res->failed()) {
            if ($command) $command->error("$url: failed download!");
            return false;
        };
        if (!Storage::exists('xml')) Storage::makeDirectory('xml');
        Storage::put($filename, $res->body());
        return true;
    }

    public static function Import($merchants, $command, $output, $filter = '')
    {
        libxml_use_internal_errors(true);
        foreach ($merchants as $merchant => $data) {
            if ($filter && !Str::contains($merchant, $filter)) {
                continue;
            }
            $output->title("[$merchant] importing");

            $filename = "xml/{$merchant}.xml";
            if (
                !Storage::exists($filename) ||
                now()->diffInHours(Carbon::createFromTimestamp(Storage::lastModified($filename))) > 12
            ) {
                if (!self::download($data['url'], $filename, $command, $output)) continue;
            }
            $body = Storage::get($filename);


            $xmlObject = simplexml_load_string(Str::of($body)->finish('</offers></shop></yml_catalog>'));
            if ($xmlObject === false) {
                $output->error('Cannot load xml source');
                Log::error("[{$merchant}]: cannot load xml source");
                continue;
            }

            $categories = $xmlObject->shop->categories;
            self::cacheCategories($categories);

            $data['filter_cat'] = $data['filter_cat'] ?? null;
            if ($data['filter_cat']) {
                $data['filter_cat'] = self::extractCats($data['filter_cat']);
            }

            $count = 0;
            Offer::where('merchant', $merchant)->delete();
            $offers = $xmlObject->shop->offers;
            $bar = $output->createProgressBar(count($offers->offer));
            foreach ($offers->offer as $offer) {
                $bar->advance();

                $filterOrFound = false;
                if ($data['filter_or'] ?? '' != '') {
                    if (Str::of($offer->name)->match($data['filter_or']) != '') {
                        $filterOrFound = true;
                    }
                }

                if (!$filterOrFound) {
                    if ($data['filter_cat']) {
                        if (!in_array((string)$offer->categoryId, $data['filter_cat'])) continue;
                    }
                    $code = "$merchant-" . trim($offer['id']);
                    if ($data['filter'] ?? '' != '') {
                        if (Str::of($offer->name)->match($data['filter']) == '') continue;
                    }
                }

                self::postProcessing($offer, $data);

                $count++;
                Offer::updateOrCreate(
                    ['code' => $code],
                    [
                        'merchant' => $merchant,
                        'ln' => $data['ln'],
                        'geo' => $data['geo'],
                        'name' => Str::limit($offer->name, 255, ''),
                        'category' => self::getBreadcrumb($offer->categoryId),
                        'pictures' => self::getPictures($data, $offer, $code), // $offer->picture,
                        'description' => self::getDescription($data, $offer, $code),
                        'summary' => self::getSummary($data, $code),
                        'alt' => self::getAlt($data, $code),
                        'price' => $offer->price,
                        'oldprice' => $offer->oldprice ?? 0,
                        'currencyId' => $offer->currencyId,
                        'url' => $offer->url,
                        'vendor' => $offer->vendor,
                        'model' => $offer->model,
                    ]
                );
            }
            $bar->finish();
            $command->info("");
            $output->success("$merchant $count created or updated.");
        }
    }

    public static function postProcessing(&$offer, &$data)
    {
        foreach ($data['post_processing'] ?? [] as $ppKey => $ppVal) {
            $offer->$ppKey = (string)Str::of($offer->$ppKey)->replaceMatches($ppVal[0], $ppVal[1]);
        }
    }

    private static function cacheCategories($categories)
    {
        self::$categories = [];
        foreach ($categories->category as $category) {
            self::$categories[(string)$category['id']] = [
                'name' => (string)$category,
                'parentId' => (string) ($category['parentId'] ?? -1)
            ];
        }
    }

    private static function getBreadcrumb(string $catId)
    {
        $currId = $catId;
        $res = [];
        while (isset(self::$categories[$currId]) && $_cat = self::$categories[$currId]) {
            $res[] = $_cat['name'];
            $currId =  $_cat['parentId'];
        }
        return join(' > ', array_reverse($res));
    }

    private static function getPictures($data, $offer, $code)
    {
        $re = '~\?v=\d+(,|\b)~';
        foreach (Arr::get($data, 'extdata.pics') ?? [] as $dir) {
            $hash = substr(md5($code), 0, 2);
            $file = "$dir/$hash/$code.txt";
            if (Storage::exists($file)) {
                return (string)Str::of(Storage::get($file))
                    ->replaceMatches($re, '')
                    ->explode(PHP_EOL)
                    ->map(fn ($item) => trim($item))
                    ->filter(fn ($item) => $item != '')
                    ->join(',');
            }
        }
        return (string)Str::of($offer->picture)->replaceMatches($re, '');
    }

    private static function getSummary($data, $code)
    {
        foreach (Arr::get($data, 'extdata.summary') ?? [] as $dir) {
            $hash = substr(md5($code), 0, 2);
            $file = "$dir/$hash/$code.txt";
            if (Storage::exists($file)) {
                return Storage::get($file);
            }
        }
        return '';
    }

    private static function getAlt($data, $code)
    {
        foreach (Arr::get($data, 'extdata.alt') ?? [] as $dir) {
            $hash = substr(md5($code), 0, 2);
            $file = "$dir/$hash/$code.txt";
            if (Storage::exists($file)) {
                return Storage::get($file);
            }
        }
        return '';
    }

    private static function getDescription($data, $offer, $code)
    {
        foreach (Arr::get($data, 'extdata.description') ?? [] as $dir) {
            $hash = substr(md5($code), 0, 2);
            $file = "$dir/$hash/$code.txt";
            if (Storage::exists($file)) {
                return Storage::get($file);
            }
        }
        if (Str::startsWith($offer->description, 'Welcome to Our Store!')) {
            return '';
        }
        return $offer->description;
    }

    private static function extractCats($cats)
    {
        $fullCats = $cats;
        foreach ($cats as $cat) {
            foreach (self::$categories as $k => $c) {
                if ($c['parentId'] == $cat) {
                    $fullCats[] = $k;
                }
            }
        }
        return $fullCats;
    }
}
