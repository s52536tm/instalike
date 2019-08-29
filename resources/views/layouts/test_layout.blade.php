<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <!--<title>Laravel S3 Example</title>-->

        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        >

        <style type="text/css" scoped>
            .main-nav a {
                margin: 10px;
                border-radius: 5px;
                background: #60B99A;
                color: #fff;
                display: block;
                padding: 15px;
                text-decoration: none;
            }
            .main-nav .logo {
                background: #4584b1;
            }
            .main-nav {
                display: flex;
                justify-content: space-between;
            }
            .main section {
                margin: 10px;
                border-radius: 5px;
                background: #F5F0CF;
                padding: 15px;
            }
            .main h1 {
                color: #E6AC27;
                font-size: 1.5rem;
            }
            .main p {
                margin-top: 10px;
            }
            .main {
                display: flex;
            }
            .main section {
                flex: 1;
            }
        </style>
    </head>

    <body>
        <header class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <span class="navbar-brand" >Instalike　login</span>
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

















<style type="text/css">
            .parent {
                display: -webkit-flex;
                display: flex;
                -webkit-flex-direction: row;
                flex-direction: column;
                -webkit-flex-wrap: nowrap;
                flex-wrap: nowrap;
            }
            .cards .card {
                vertical-align: top;
                display: inline-block;
            }
            .nav-link{
                display: inline-block;
            }
            div{
                max-width: 100%;
                margin: 0 auto;
            }
            .button_balloon_down {
                position: relative;
                display: inline-block;
                left: 43%;
                margin: 1.5em 0;
                padding: 0 0px;
                width: 100px;
                height: 100px;
                line-height: 100px;
                text-align: center;
                color: #FFF;
                font-size: 20px;
                font-weight: bold;
                background: #70a6ff;
                border-radius: 100%;
                box-sizing: border-box;
            }
            .button_balloon_down:before {
                content: "";
                position: absolute;
                bottom: -25px;
                left: 49%;
                margin-left: -15px;
                border: 15px solid transparent;
                border-top: 15px solid #70a6ff;
                z-index: 0;
            }
            .button_balloon_up {
                position: relative;
                display: inline-block;
                left: 43%;
                margin: 1.5em 0;
                padding: 0 0px;
                width: 100px;
                height: 100px;
                line-height: 100px;
                text-align: center;
                color: #FFF;
                font-size: 20px;
                font-weight: bold;
                background: #a4eb84;
                border-radius: 100%;
                box-sizing: border-box;
            }
            .button_balloon_up:before {
                content: "";
                position: absolute;
                top: -25px;
                left: 49%;
                margin-left: -15px;
                border: 15px solid transparent;
                border-bottom: 15px solid #a4eb84;
                z-index: 0;
            }
            .camera_icon {
                color: #000;
                position: relative;
                width: 80px;
                height: 50px;
                border-radius: 5px;
                border: solid 5px currentColor;
            }
            .camera_icon:before {
                content: '';
                position: absolute;
                left: 25px;
                top: 10px;
                width: 20px;
                height: 20px;
                border-radius: 15px;
                border: solid 5px currentColor;
            }
            .camera_icon:after {
                content: '';
                position: absolute;
                right: 10px;
                top: -10px;
                width: 25px;
                height: 5px;
                border-radius: 5px 5px 0 0;
                background-color: currentColor;
            }
        </style>
