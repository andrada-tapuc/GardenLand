<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services_category extends Model
{
    protected $fillable = [
        'id', 'parent_id', 'name_category'
    ];
    protected $primaryKey = 'id';
    protected $table = 'services_categories';

    public function image(){
        return $this->hasOne(Image_Category::class, 'category_id', 'id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Services_category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Services_category::class, 'parent_id', 'id');
    }

    public function childrenCategories()
    {
        return $this->categories()->with('childrenCategories');
    }

    public function children()
    {
        return $this->hasMany(Services_category::class,  'parent_id','id');
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
