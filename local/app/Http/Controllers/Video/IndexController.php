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

        if($video_top->type_link == 2){
            $name = explode('v=',$video_top->url_video);
            $videoId = '';
            if(isset($name[1])) $videoId = $name[1];
            else {
                $name = explode('/',$video_top->url_video);
                if(isset($name[count($name)-1])) $videoId = $name[count($name)-1];
            }
            if($videoId) {
                $theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoId&format=json";
                $headers = get_headers($theURL);
                $video_top->img_thumbnail = "http://img.youtube.com/vi/$videoId/hqdefault.jpg";
            }
            else $video_top->img_thumbnail = null;
        }

        $group = DB::table('menu_video')->find($video_top->groupid);

        $video_top->group = $group;

        $video_top->created_at = date('H:m - d/m/y',$video_top->created_at);

        foreach ($menu_video as $menu){
            $videos = $menu->get_video();

            foreach ($videos as $key => $video){
                if($video->type_link == 2){
                    $name = explode('v=',$video->url_video);
                    $videoId = '';
                    if(isset($name[1])) $videoId = $name[1];
                    else {
                        $name = explode('/',$video->url_video);
                        if(isset($name[count($name)-1])) $videoId = $name[count($name)-1];
                    }
                    if($videoId) {
                        $theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoId&format=json";
                        $headers = get_headers($theURL);
                        if(substr($headers[0], 9, 3) == "404") {
                            unset($videos[$key]);
                            continue;
                        }
                        $video->img_thumbnail = "http://img.youtube.com/vi/$videoId/hqdefault.jpg";
                    }
                    else $video->img_thumbnail = null;
                }
            }
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

        if($video->type_link == 2){
            $name = explode('v=',$video->url_video);
            $videoId = '';
            if(isset($name[1])) $videoId = $name[1];
            else {
                $name = explode('/',$video->url_video);
                if(isset($name[count($name)-1])) $videoId = $name[count($name)-1];
            }
            if($videoId) {
                $video->img_thumbnail = "http://img.youtube.com/vi/$videoId/hqdefault.jpg";
            }
            else $video->img_thumbnail = null;
        }

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

        foreach ($list_video as $key => $video){
            if($video->type_link == 2){
                $video->created_at = date('H:m - d/m/y',$video->created_at);

                $name = explode('v=',$video->url_video);
                $videoId = '';
                if(isset($name[1])) $videoId = $name[1];
                else {
                    $name = explode('/',$video->url_video);
                    if(isset($name[count($name)-1])) $videoId = $name[count($name)-1];
                }
                if($videoId) {
                    $theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoId&format=json";
                    $headers = get_headers($theURL);
                    if(substr($headers[0], 9, 3) == "404") {
                        unset($list_video[$key]);
                        continue;
                    }
                    $video->img_thumbnail = "http://img.youtube.com/vi/$videoId/hqdefault.jpg";
                }
                else $video->img_thumbnail = null;
            }
        }
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
