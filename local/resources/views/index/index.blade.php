@extends('master')
@section('main')
    <div id="main">
        <div id="mySidebar">
            <ul>
                @foreach($menu_video as $menu)
                    <li class="{{$loop->index == 0 ? 'active' : ''}}"><a><i class="{{$menu->icon}}"></i>{{$menu->title}}</a></li>
                @endforeach
            </ul>
        </div>

        <div id="content">
            <div class="top-video">
                <div class="row">
                    <div class="col-md-8">
                        @if(file_exists(asset('/local/resources'.$video_top->url_video)))
                            <video height="415" width="100%">
                                <source src="{{ asset('/local/resources'.$video_top->url_video) }}">
                            </video>
                        @else
                            <iframe width="100%" height="415" src="{{ (file_exists(asset('/local/resources'.$video_top->url_video)) ? : file_exists('http://vietnamhoinhap.vn/'.$video_top->url_video) ? : '') ? : $video_top->url_video }}">
                            </iframe>
                        @endif
                    </div>
                    <div class="col-md-4" style="padding-right: 30px">
                        <div class="title-cate">
                            <h3>{{$video_top->group->title}}</h3>
                        </div>

                        <div class="title-video">
                            <h3>{{$video_top->title}}</h3>
                        </div>

                        <p class="time-video"><i class="fa fa-clock"></i> {{$video_top->created_at}} - VNHN</p>

                        <div class="list-icon">
                            <ul>
                                <li><a class="btn facebook"><span><i class="fa fa-thumbs-up"></i>like 0</span></a></li>
                                <li><a class="btn facebook"><span>share</span></a></li>
                                <li><a class="btn google" style="border: 1px solid #999999"><i style="color: #d7191f" class="fab fa-google-plus-g"></i>chia sẻ</a></li>
                            </ul>
                        </div>

                        <p class="caption">{!! $video_top->summary !!}</p>
                    </div>
                </div>

            </div>

            <div class="video-group">

                @foreach($menu_video as $group)
                    <div class="group-top">
                        <h3 class="float-left">{{$group->title}}</h3>
                        <p class="float-right">Xem thêm</p>
                    </div>

                    <div class="row form-group" style="width: 100%">
                        @foreach($group->videos as $video)
                            <div class="item col-md-3">
                                @if(file_exists(asset('/local/resources'.$video->url_video)))
                                    <video height="415" width="100%">
                                        <source src="{{ asset('/local/resources'.$video->url_video) }}">
                                    </video>
                                @else
                                    <iframe width="100%" height="150px" src="{{ (file_exists(asset('/local/resources'.$video->url_video)) ? : file_exists('http://vietnamhoinhap.vn/'.$video->url_video) ? : '') ? : $video->url_video }}"></iframe>
                                    <h3>{{$video->title}}</h3>
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
