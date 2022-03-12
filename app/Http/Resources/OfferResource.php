<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'rank' => $this->rank,
            'code' => $this->code,
            'name' => $this->name,
            'category' => $this->category,
            'description' => permutation($this->description, $request->input('host')),
            'url' => $this->url,
            'pictures' => $this->pictures,
            'price' => $this->price,
            'oldprice' => $this->oldprice,
            'currencyId' => $this->currencyId,
            'vendor' => $this->vendor,
            'vendor' => $this->vendor,
            'model' => $this->model,
        ];
    }

    private function getULP($url)
    {
        $parts = parse_url(trim($url));
        parse_str($parts['query'], $query);
        return trim($query['ulp']);
    }


}
