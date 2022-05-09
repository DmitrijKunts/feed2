<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class OfferResource extends JsonResource
{
    // public static $wrap = 'offers';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $noise = $this->code . $request->input('host');

        $alts = collect([]);
        foreach (range(0, 3 + genConst(4, $noise)) as $v) {
            $alts->push(deDouble($this->name) . ($v == 0 ? '' : " #$v"));
        }
        $alts = constSort(
            Str::of($this->alt)->explode(PHP_EOL),
            $noise
        )->map(fn ($i) => trim(deDouble($i)))
            ->filter(fn ($i) => $i != '')
            ->merge($alts)
            ->slice(0, 3 + genConst(4, $noise));

        return [
            'rank' => $this->rank,
            'code' => $this->code,
            'name' => deDouble($this->name),
            'category' => $this->category,
            'description' => permutation($this->description, $noise),
            'summary' => permutation($this->summary, $noise),
            'url' => $this->url,
            'pictures' => constSort(
                Str::of($this->pictures)->explode(','),
                $noise
            )->slice(0, 3 + genConst(4, $noise)), //$this->pictures,
            'alts' => $alts,
            'price' => $this->price,
            'oldprice' => $this->oldprice,
            'currencyId' => $this->currencyId,
            'vendor' => $this->vendor,
            'vendor' => $this->vendor,
            'model' => $this->model,
        ];
    }

}
