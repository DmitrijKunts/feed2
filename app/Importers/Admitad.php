<?php

namespace App\Importers;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class Admitad
{
    private static $categories = [];

    public static function download($url, $filename, $command)
    {
        if (!Storage::delete($filename)) {
            $command->error("$filename not deleted!");
            return false;
        }
        $command->info("Downloading...");
        $res = Http::withOptions([
            'verify' => false,
        ])->timeout(600)->get($url,);

        if ($res->failed()) {
            $command->error("$url: failed download!");
            return false;
        };
        if (!Storage::exists('xml')) Storage::makeDirectory('xml');
        Storage::put($filename, $res->body());
        return true;
    }

    public static function Import($merchants, $command, $output)
    {
        foreach ($merchants as $merchant => $data) {
            $output->title("[$merchant] importing");

            $filename = "xml/{$merchant}.xml";
            if (
                !Storage::exists($filename) ||
                now()->diffInHours(Carbon::createFromTimestamp(Storage::lastModified($filename))) > 6
            ) {
                if (!self::download($data['url'], $filename, $command)) continue;
            }
            $body = Storage::get($filename);


            $xmlObject = simplexml_load_string($body);

            $categories = $xmlObject->shop->categories;
            self::cacheCategories($categories);

            $count = 0;
            Offer::where('merchant', $merchant)->delete();
            $offers = $xmlObject->shop->offers;
            $bar = $output->createProgressBar(count($offers->offer));
            foreach ($offers->offer as $offer) {
                $bar->advance();

                $code = "$merchant-" . trim($offer['id']);
                if (Str::of($offer->name)->match($data['filter']) == '') continue;
                $count++;
                Offer::updateOrCreate(
                    ['code' => $code],
                    [
                        'merchant' => $merchant,
                        'ln' => $data['ln'],
                        'name' => $offer->name,
                        'category' => self::getBreadcrumb($offer->categoryId),
                        'pictures' => $offer->picture,
                        'description' => self::getDescription($data, $offer, $code),
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
            $output->success("$merchant $count created or updated.");
        }
    }

    private static function cacheCategories($categories)
    {
        self::$categories = [];
        foreach ($categories->category as $category) {
            self::$categories[(int)$category['id']] = [
                'name' => (string)$category,
                'parentId' => (int)$category['parentId']
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
}
