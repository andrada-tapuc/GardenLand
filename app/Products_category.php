<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products_category extends Model
{
    protected $fillable = [
        'id', 'parent_id', 'name_category'
    ];
    protected $primaryKey = 'id';
    protected $table = 'products_categories';

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Products_category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Products_category::class, 'parent_id', 'id');
    }

    public function childrenCategories()
    {
        return $this->categories()->with('childrenCategories');
    }

    public function children()
    {
        return $this->hasMany(Products_category::class,  'parent_id','id');
    }

    public static function index()
    {
        return self::where('parent_id', null)
            ->with('parent')
            ->whereHas('childrenCategories')
            ->with('childrenCategories')
            ->get();
    }

}
