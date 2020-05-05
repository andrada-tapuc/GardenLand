<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'id', 'category_id', 'name', 'price', 'time_exec'
    ];
    protected $primaryKey = 'id';
    protected $table = 'services';

    public function category()
    {
        return $this->belongsTo(Services_category::class,'category_id','id');
    }
    public function image()
    {
        return $this->hasMany(Image_Service::class, 'service_id', 'id');
    }

    public static function getServices($cat_id){
        return self::where('category_id', $cat_id)->get();
    }
}
