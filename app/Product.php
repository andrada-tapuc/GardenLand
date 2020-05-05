<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id', 'category_id', 'name', 'price', 'time_exec'
    ];
    protected $primaryKey = 'id';
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Products_category::class,'category_id','id');
    }
    public function image()
    {
        return $this->hasMany(Image_Product::class, 'product_id', 'id');
    }

}
