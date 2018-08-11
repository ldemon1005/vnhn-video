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
