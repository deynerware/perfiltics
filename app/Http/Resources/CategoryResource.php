<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'                => (int)    $this->id,
            'sub_category'      => (int)    $this->sub_category,
            'name'              => (string) $this->name,
            'created_at'        => (string) $this->created_at,
            'updated_at'        => (string) $this->updated_at,
            'products'          => (array)  $this->products->toArray(),
        ];
    }
}
