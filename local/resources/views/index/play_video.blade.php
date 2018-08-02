<div class="row">
    <div class="col-md-8">
        @if(file_exists(asset('/local/resources'.$video->url_video)))
            <video height="415" width="100%">
                <source src="{{ asset('/local/resources'.$video->url_video) }}">
            </video>
        @else
            <iframe width="100%" height="415" src="{{ (file_exists(asset('/local/resources'.$video->url_video)) ? : file_exists('http://vietnamhoinhap.vn/'.$video->url_video) ? : '') ? : $video->url_video }}">
            </iframe>
        @endif
    </div>
    <div class="col-md-4" style="padding-right: 30px">
        <div class="title-cate">
            <h3>{{$video->group->title}}</h3>
        </div>

        <div class="title-video">
            <h3>{{$video->title}}</h3>
        </div>

        <p class="time-video"><i class="fa fa-clock"></i> {{$video->created_at}} - VNHN</p>
        <div class="row" style="margin: 0;line-height: 22px">
            <div class="g-ytsubscribe" data-channel="GoogleDevelopers" data-layout="default" data-count="default"></div>
            <div style="margin-left: 15px" class="fb-share-button" data-href="{{asset('?video='.$video->slug.'---n-'.$video->id)}}" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
        </div>
        <p class="caption">{!! $video->summary !!}</p>
    </div>
</div>
<script src="https://apis.google.com/js/platform.js"></script>

<div id="fb-root"></div>

<script src="js/custom.js"></script>

