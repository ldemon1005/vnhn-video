<div id="header">
    <div class="icon-left">
        <a style="cursor: pointer;display: none" id="open-menu" onclick="w3_open();"><i class="fas fa-bars"></i></a>
        <a style="cursor: pointer" id="close-menu" onclick="w3_close();"><i class="fas fa-bars"></i></a>
    </div>

    <div class="logo-center">
        <div class="logo-top">
            <a href="{{route('index')}}"><img src="{{asset('local/resources/assets/images/logo-video.png')}}"></a>
        </div>
    </div>

    <div class="search-right">
        <div class="search-top">
            <div class="row form-group">
                <div class="col-md-6"></div>
                <div class="col-md-6" style="position: relative">
                    <form id="search_video" action="{{route('search_video')}}" method="get">
                        <input name="key" type="text" class="form-control" placeholder="Từ khóa tìm kiếm ...">
                        <a onclick="search_video()" style="cursor: pointer"><i
                                    class="fas fa-search" style="color: #303840"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>