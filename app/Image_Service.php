<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image_Service extends Model
{
    protected $fillable = [
        'id', 'service_id', 'title','description','name'
    ];
    protected $primaryKey = 'id';
    protected $table = 'service_images';
    public $timestamps = true;

    public function service()
    {
        return $this->hasOne(Service::class, 'service_id', 'id');
    }
}
