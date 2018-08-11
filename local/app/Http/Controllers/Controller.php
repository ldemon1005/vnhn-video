<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    function __construct()
    {
        $info = $this->web_info();
        View::share('web_info',$info);
    }

    function web_info(){
        $info = DB::table('web_info_vn')->first();
        $info = (object)json_decode($info->info,true);
        return $info;
    }
}
