<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuVideo extends Model
{
    protected $table = 'menu_video';

    public $timestamps = false;

    public $guarded = [];

    public function get_video(){
        return $this->hasMany(Video_vn::class,'groupid','id')->take(4)->get();
    }
}
