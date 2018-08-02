<div class="d-flex">
    <div class="top-video-player">
        @if(file_exists(asset('/local/resources'.$video->url_video)))
            <video height="415" width="100%">
                <source src="{{ asset('/local/resources'.$video->url_video) }}">
            </video>
        @else
            <iframe width="100%" height="415" src="{{ (file_exists(asset('/local/resources'.$video->url_video)) ? : file_exists('http://vietnamhoinhap.vn/'.$video->url_video) ? : '') ? : $video->url_video }}">
            </iframe>
        @endif
    </div>
    <div class="top-video-content">
        <div class="title-cate">
            <h3>{{$video->group->title}}</h3>
        </div>

        <div class="title-video">
            <h3>{{$video->title}}</h3>
        </div>

        <p class="time-video"><i class="fa fa-clock"></i> {{$video->created_at}} - VNHN</p>
        <div class="d-flex">
            <div class="g-ytsubscribe" data-channel="GoogleDevelopers" data-layout="default" data-count="default"></div>
            <div style="margin-left: 10px!important;" class="fb-like" data-href="{{asset ('?video='
                            .$video->slug.'---n-'
                            .$video->id)}}"
                 data-action="like" data-size="small" data-layout="button_count"
                 data-share="true"></div>
        </div>
        <p class="caption">{!! $video->summary !!}</p>
    </div>
</div>
<script src="https://apis.google.com/js/platform.js"></script>

<div id="fb-root"></div>

<script src="js/custom.js"></script>