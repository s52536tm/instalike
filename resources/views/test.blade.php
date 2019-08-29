@extends('layouts.test_layout')
@section('content')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ログイン画面</title>
    </head>

    <script>
    $(function() {
        $('.btn').on('click', function() {
            $('.btn').prop('disabled', true);
        });
    });
    </script>
        <form action="home" method="get">
            <button class="btn">送信</button>
        </form>

    
    
    <body>
        <nav>
            <div class="main-nav">
                <a href="#" class="logo">Logo</a>
                <a href="#">Menu 1</a>
                <a href="#">Menu 2</a>
                <a href="#">Menu 3</a>
                <a href="#">Menu 4</a>
            </div>
        </nav>
        <div class="main">
            <section class="col_1">
                <h1>Column 1</h1>
                <p>さわやかな風が吹いて木々の枝揺らしている。木漏れ日のその下を歩きながら思う、「どんな道もきっとどこかへ続く」。</p>
            </section>
            <section class="col_2">
                <h1>Column 2</h1>
                <p>あの頃の私たちは今いる場所もわからずに、暗くて見えない道、星を探すように胸の奥の夢を手掛かりにしてた。辛いこともいっぱいあった。幾つもの坂上った。</p>
                <p>迷ってるのは私だけじゃないんだ。そばにいつだって誰かいる。いいこと一つ、今日の中に見つけて悲しみを一つ忘れよとしてきた。</p>
            </section>
            <section class="col_3">
                <h1>Column 3</h1>
                <p>思い通りに何もいかないけれど、それでも誰もが前を向く。みんな同じだ迷い悩み傷つく。悲しくなったらもっともっと泣こうよ。</p>
            </section>
        </div>
    </body>
</html>

@endsection
