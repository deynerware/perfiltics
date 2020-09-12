<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'sub_category', 'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
