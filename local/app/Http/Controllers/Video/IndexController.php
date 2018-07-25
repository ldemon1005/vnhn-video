<?php

namespace App\Http\Controllers\Video;

use App\Models\MenuVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    function index(){
        $menu_video = MenuVideo::where('status',1)->get();

        $video_top = DB::table('video_vn')->where('status',1)->orderByDesc('release_time')->first();

        $group = DB::table('menu_video')->find($video_top->groupid);

        $video_top->group = $group;

        $video_top->created_at = date('H:m - d/m/y',$video_top->created_at);

        foreach ($menu_video as $menu){
            $menu->videos = $menu->get_video();
        }

        $data = [
            'menu_video' => $menu_video,
            'video_top' => $video_top,
        ];

        return view('index.index',$data);
    }
}
