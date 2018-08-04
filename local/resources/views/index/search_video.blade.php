@extends('master')
@section('main')
    <div id="main">
        <div id="mySidebar">
            <ul>
                <li><a href="{{asset('')}}"><i class="fas fa-home"></i>Trang chủ</a></li>
                @foreach($menu_video as $menu)
                    <li><a href="{{route('get_list_video',$menu->slug."---n-".$menu->id)}}"><i
                                    class="{{$menu->icon}}"></i>{{$menu->title}}</a></li>
                @endforeach
            </ul>
        </div>
        <div id="content">
            @if($video_top)
                <div class="top-video" style="margin-bottom: 30px">
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
                            <div class="title-video">
                                <h3>{{$video_top->title}}</h3>
                            </div>

                            <p class="time-video"><i class="fa fa-clock"></i> {{$video_top->created_at}} - VNHN</p>
                            <div class="row" style="margin: 0;line-height: 22px">
                                <div class="g-ytsubscribe" data-channel="GoogleDevelopers" data-layout="default"
                                     data-count="default"></div>

                                <div style="margin-left: 10px!important;" class="fb-like" data-href="{{asset ('?video='.$video_top->slug.'---n-'.$video_top->id)}}"
                                     data-action="like" data-size="small" data-layout="button_count" data-show-faces="true"
                                     data-share="true"></div>
                            </div>
                            <p class="caption">{!! $video_top->summary !!}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="video-group">
                <div class="row form-group" style="width: 100%">
                    @foreach($list_video as $video)
                        <div class="item col-md-3">
                            @if(file_exists(asset('/local/resources'.$video->url_video)))
                                <video height="415" width="100%">
                                    <source src="{{ asset('/local/resources'.$video->url_video) }}">
                                </video>
                            @else
                                <a style="text-decoration: none;color: #000000;cursor: pointer"
                                   onclick="play_video('{{$video->id}}')">
                                    <img style="width: 100%;padding-bottom: 10px" src="{{$video->img_thumbnail}}">
                                    <h3>{{$video->title}}</h3>
                                </a>
                            @endif
                            <p class="time-video"><i class="fa fa-clock"></i> {{$video->created_at}}
                                - VNHN</p>
                        </div>
                    @endforeach
                </div>
                <div class="row float-right">
                    {!! $list_video->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        function play_video(id) {
            $.ajax({
                url: '/video/' + id,
                method: 'get',
                dataType: 'json',
            }).fail(function (ui, status) {
            }).done(function (data, status) {
                if(data){
                    $(".top-video").html(data.content);
                    FB.XFBML.parse(document.getElementById('buttonShare'));
                    $('html, body').animate({scrollTop: "0px"});
                    $.getScript()
                }
            })
        }
    </script>
@stop