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
        // dd($request->input('host'));
        return [
            'rank' => $this->rank,
            'code' => $this->code,
            'name' => $this->name,
            'url' => $this->url,
        ];
    }

    private function getULP($url){
        $parts = parse_url(trim($url));
        parse_str($parts['query'], $query);
        return trim($query['ulp']);
    }
}
