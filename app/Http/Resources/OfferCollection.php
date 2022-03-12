<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OfferCollection extends ResourceCollection
{
    private $meta = [];
    public static $wrap = '';

    public function __construct($resource, $meta = [])
    {
        parent::__construct($resource);
        $this->meta = $meta;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return collect($this->meta)->merge([
            'success' => true,
            'offers' => $this->collection,
        ])->all();
    }
}
