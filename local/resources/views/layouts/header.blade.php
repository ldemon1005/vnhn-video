<div id="header">
    <div class="icon-left">
        <a style="cursor: pointer;display: none" id="open-menu" onclick="w3_open();"><i class="fas fa-bars"></i></a>
        <a style="cursor: pointer" id="close-menu" onclick="w3_close();"><i class="fas fa-bars"></i></a>
    </div>

    <div class="logo-center">
        <div class="logo-top">
            <a href="#"><img src="{{asset('local/resources/assets/images/logo-video.png')}}"></a>
        </div>
    </div>

    <div class="search-right">
        <div class="search-top">
            <form>
                <div class="row form-group">
                    <div class="col-md-6"></div>
                    <div class="col-md-6" style="position: relative">
                        <input type="text" class="form-control" placeholder="Từ khóa tìm kiếm ...">
                        <a href=""><i class="fas fa-search" style="color: #303840"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
@stop