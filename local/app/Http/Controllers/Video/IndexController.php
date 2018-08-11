<?php

namespace App\Http\Controllers\Video;

use App\Models\MenuVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    function index(Request $request){
        $url = $request->get('video');

        $url = explode('---n-',$url);

        $video_id = $url[count($url)-1];

        $menu_video = MenuVideo::where('status',1)->orderBy('order')->get();

        if($video_id){
            $video_top = DB::table('video_vn')->find($video_id);
        }else $video_top = DB::table('video_vn')->where('status',1)->orderByDesc('release_time')->first();

        $group = DB::table('menu_video')->find($video_top->groupid);

        $video_top->group = $group;

        $video_top->created_at = date('H:m - d/m/y',$video_top->created_at);

        foreach ($menu_video as $menu){
            $videos = $menu->get_video();
            $menu->videos = $videos;
        }
        $data = [
            'menu_video' => $menu_video,
            'video_top' => $video_top,
        ];

        return view('index.index',$data);
    }

    function play_video($id){
        $video = DB::table('video_vn')->find($id);

        $group = DB::table('menu_video')->find($video->groupid);

        $video->group = $group;

        $video->created_at = date('H:m - d/m/y',$video->created_at);

        $data = [
            'video' => $video
        ];
        $view = View::make('index.play_video',$data)->render();
        $url = $video->slug.'---n-'.$video->id;
        $video->link = asset($url);

        return json_encode([
            'content' => $view,
            'meta_fb' => $video
        ]);
    }

    function search_video(Request $request){
        $menu_video = MenuVideo::where('status',1)->orderBy('order')->get();

        $key_w = $request->get('key');
        $list_video = DB::table('video_vn')->where('title','like',"%$key_w%")
            ->orWhere('summary','like',"%$key_w%")
            ->orderByDesc('release_time')
            ->paginate(8);

        if ($list_video->count()) {
            $video_top = array_values($list_video->slice(0,1)->toArray())[0];
        } else $video_top = null;
        $list_video->appends(['key' => $key_w]);
        $data = [
            'list_video' => $list_video,
            'video_top' => $video_top,
            'menu_video' => $menu_video
        ];

        return view('index.search_video',$data);
    }
}
