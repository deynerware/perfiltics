<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => (int)    $this->id,
            'category_id'   => (int)    $this->category_id,
            'name'          => (string) $this->name,
            'price'         => (int)    $this->price,
            'quantity'      => (int)    $this->quantity,
            'created_at'    => (string) $this->created_at,
            'updated_at'    => (string) $this->updated_at,
            'category'      => (array)  $this->category->toArray(),   
        ];
    }
}
