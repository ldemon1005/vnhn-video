<?php

namespace App\Http\Controllers\Video;

use App\Models\MenuVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    function get_list($slug){
        $slug = explode('---n-',$slug);

        $group_id = $slug[1];

        $group = MenuVideo::find($group_id);

        $menu_video = MenuVideo::where('status',1)->orderBy('order')->get();

        $list_video = DB::table('video_vn')->where('groupid',$group_id)->orderByDesc('release_time')->paginate(9);


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

        if ($list_video) {
            $video_top = array_values($list_video->slice(0,1)->toArray())[0];
        } else $video_top = (object)[];
        $data = [
            'list_video' => $list_video,
            'menu_video' => $menu_video,
            'video_top' => $video_top,
            'group' => $group
        ];

        return view('index.group',$data);
    }
}
