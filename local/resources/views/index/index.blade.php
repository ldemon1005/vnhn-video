@extends('master')
@section('main')
    <div id="main">
        <div id="mySidebar">
            <ul>
                <li class="active"><a href="{{asset('')}}"><i class="fas fa-home"></i>Trang chủ</a></li>
                @foreach($menu_video as $menu)
                    <li><a href="{{route('get_list_video',$menu->slug."---n-".$menu->id)}}">
                            <i class="{{$menu->icon}}"></i>{{$menu->title}}</a></li>
                @endforeach
            </ul>
        </div>
        <div id="content">
            <div class="top-video">
                <div class="d-flex">
                    <div class="top-video-player">
                        @if($video_top->type_link == 1)
                            {{--<video height="415" width="100%">--}}
                                {{--<source src="">--}}
                            {{--</video>--}}

                            <video height="415" width="100%" controls>
                                <source src="{{ 'http://vietnamhoinhap.vn'.$video_top->url_video }}" type="video/mp4">
                                Your browser does not support HTML5 video.
                            </video>
                        @else
                            <iframe width="100%" height="415" src="{{ (file_exists(asset('/local/resources'.$video_top->url_video)) ? : file_exists('http://vietnamhoinhap.vn/'.$video_top->url_video) ? : '') ? : $video_top->url_video }}">
                            </iframe>
                        @endif
                    </div>
                    <div class="top-video-content">
                        <div class="title-cate">
                            <h3>{{$video_top->group->title}}</h3>
                        </div>

                        <div class="title-video">
                            <h3>{{$video_top->title}}</h3>
                        </div>

                        <p class="time-video"><i class="fa fa-clock"></i> {{$video_top->created_at}} - VNHN</p>
                        <div class="d-flex">
                            <div class="g-ytsubscribe" data-channel="GoogleDevelopers"
                                 data-layout="default"
                                  data-count="default"></div>

                            {{--<div id="buttonShare" class="fb-share-button ml-2" data-href="{{asset('?video='.$video_top->slug.'---n-'.$video_top->id)}}" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>--}}
                            <div style="margin-left: 10px!important;" class="fb-like" data-href="{{asset ('?video='
                            .$video_top->slug.'---n-'
                            .$video_top->id)}}"
                                 data-action="like" data-size="small" data-layout="button_count" data-show-faces="true"
                                 data-share="true"></div>
                        </div>
                        <p class="caption">{!! $video_top->summary !!}</p>
                    </div>
                </div>
            </div>

            <div class="video-group">
                @foreach($menu_video as $group)
                    <div class="group-top d-flex align-items-center">
                        <h3 class="flex-grow-1">{{$group->title}}</h3>
                        <a href="{{route('get_list_video',$group->slug."---n-".$group->id)}}" class="more-btn">Xem thêm</a>
                    </div>
                    <div class="row form-group" style="width: 100%">
                        @foreach($group->videos as $video)
                            <div class="item col-md-3">
                                @if($video->type_link == 1)
                                    <video height="415" width="100%">
                                        <source src="{{ asset('/local/resources'.$video->url_video) }}">
                                    </video>
                                @else
                                    <a style="text-decoration: none;color: #000000;cursor: pointer" onclick="play_video('{{$video->id}}')">
                                        <img style="width: 100%;padding-bottom: 10px" src="{{$video->avatar}}">
                                        <h3>{{$video->title}}</h3>
                                    </a>
                                @endif
                                <p class="time-video"><i class="fa fa-clock"></i> {{date('H:m - d/m/y',$video->created_at)}} - VNHN</p>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('script')
@stop