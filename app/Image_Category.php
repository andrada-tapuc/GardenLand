<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image_Category extends Model
{
    protected $fillable = [
        'id', 'category_id', 'name'
    ];
    protected $primaryKey = 'id';
    protected $table = 'image_categories';
    public $timestamps = true;

    public function category()
    {
        return $this->hasOne(Services_category::class, 'category_id', 'id');
    }
}
