<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <base href="{{ asset('local/resources/assets/') }}/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VNHN-Video</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    @yield('css')
<!-- Styles -->
</head>
<body>
@include('layouts.header')
@yield('main')
@include('layouts.footer')
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://apis.google.com/js/platform.js"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=761158710724257&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
    function w3_open() {
        document.getElementById("mySidebar").style.width = "280px";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("open-menu").style.display = "none";
        document.getElementById("close-menu").style.display = "inherit ";
    }
    function w3_close() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("open-menu").style.display = "inherit ";
        document.getElementById("close-menu").style.display = "none";
    }

    function back_to_top() {
        $('html, body').animate({scrollTop: "0px"});
    }

    function search_video() {
        document.getElementById('search_video').submit();
    }

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
//                $.getScript();
                $('html, body').animate({scrollTop: "0px"});
            }
        })
    }
</script>


@yield('script')
</html>
