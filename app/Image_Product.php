<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image_Product extends Model
{
    protected $fillable = [
        'id', 'product_id', 'title','description' , 'name'
    ];
    protected $primaryKey = 'id';
    protected $table = 'product_images';
    public $timestamps = true;

    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
}
