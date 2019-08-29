<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <title>Laravel S3 Example</title>

        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        >

        <style type="text/css">
            .button_wrapper{
                text-align:center;
            }
            .nav-link{
                display: inline-block;
            }
            div{
                max-width: 100%;
                margin: 0 auto;
            }
            
        </style>
    </head>

    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        var clickFlg = true;
        jQuery(function($) {
            $(".nav-link").on("click", function() {
                if(clickFlg) {
                    // イベント処理中はフラグをoffにします。
                    clickFlg = false;
                    // クリック処理を実施
                } else {
                    // イベント処理中は処理しない
                    return false;
                }
            });
        });
    </script>

    <body>
        <header class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <span class="navbar-brand">Instalike</span>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/home">
                                | ホ ー ム |
                            </a>

                            @auth <!-- ログイン時の処理　-->
                            <a class="nav-link" href="/logout/github">
                                | ログアウト |
                            </a>
                            <a class="nav-link" href="/home/create">
                                |　投　稿　|
                            </a>
                            @endauth

                            @guest  <!-- 未ログイン時の処理 -->
                            <a class="nav-link" href="/logout/github">
                                | ログイン |
                            </a>
                            <a class="nav-link" href="/logout/github">
                                |　投　稿　|
                            </a>
                            @endguest
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="container py-md-3">
            @yield('content')
        </div>

        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"
        >
        </script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"
        >
        </script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"
        >
        </script>
    </body>
</html>