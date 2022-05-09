<?php

namespace App\Http\Controllers;

use App\Actions\SearchAction;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\OfferCollection;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OfferController extends Controller
{
    public function search(SearchRequest $request, SearchAction $action)
    {
        [$offers, $query] = $action->handle($request->validated());

        return new OfferCollection($offers, compact('query'));
    }

    public function presents(string $merchant)
    {
        $res = collect(Offer::where('merchant', $merchant)->get())->map(function ($i) {
            return "{$i->code}\t" . getULP($i->url);
        })->implode(PHP_EOL) . PHP_EOL;
        return response($res, 200, ['Content-Type' => 'text/html; charset=UTF-8']);
    }

    public function presentsDescription(string $code)
    {
        $o = Offer::where('code', $code)->firstOrFail();

        return response($o->description, 200, ['Content-Type' => 'text/html; charset=UTF-8']);
    }

    public function presentsName(string $code)
    {
        $o = Offer::where('code', $code)->firstOrFail();

        return response($o->name, 200, ['Content-Type' => 'text/html; charset=UTF-8']);
    }

}
