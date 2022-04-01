<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferCollection;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    // public function search(OfferSearchRequest $request)
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required|max:255',
            'ln' => 'required|in:english,russian',
            'geo' => 'required|in:en,ru,ua',
            'host' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'errors'      => $validator->errors()
            ]);
        }
        $validated = $validator->validated();

        $query = (string)Str::of($validated['q'])
            ->replaceMatches('~[\?:\'"|!&\(\)\-\+\*<>/\\\\]~', ' ')
            ->replaceMatches('~\b\w{1,2}\b~u', '')
            ->trim()
            ->replaceMatches('~\s+~', '|');

        $offers = Offer::where('ln', $validated['ln'])
            ->where('geo', $validated['geo'])
            ->whereRaw("tsv <=> to_tsquery(ln::regconfig, '$query') < 1.0")
            ->select(DB::Raw("offers.*, tsv <=> to_tsquery(ln::regconfig, '$query') as rank"))
            ->orderBy('rank')
            ->limit(20)
            ->get();


        return new OfferCollection($offers, compact('query'));
    }

    public function presents(string $merchant)
    {
        $res = collect(Offer::where('merchant', $merchant)->get())->map(function ($i) {
            return "{$i->code}\t" . $this->getULP($i->url);
        })->implode(PHP_EOL) . PHP_EOL;
        return response($res, 200, ['Content-Type' => 'text/html; charset=UTF-8']);
    }

    public function presentsDescription(string $code)
    {
        $o = Offer::where('code', $code)->firstOrFail();

        return response($o->description, 200, ['Content-Type' => 'text/html; charset=UTF-8']);
    }

    private function getULP($url)
    {
        $parts = parse_url(trim($url));
        parse_str($parts['query'], $query);
        return trim($query['ulp']);
    }
}
