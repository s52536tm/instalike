@extends('layout')

@section('content')
    <a href="/">ログアウト</a>

    <h2>画像一覧</h2>

    <div style="margin: 2rem 0;">
        <form action="/post" method="get">
            <button class="btn btn-primary">画像登録</button>
        </form>
    </div>

    <div class="cards">
        @foreach ($files as $file)
            <div class="card" style="width: 24%;">
                <img class="card-img-top" src="http://192.168.55.44:9000/instalike/{{"${file}"}}" style="height: auto;">

                <div class="card-body">
                    <form action="/post/{{"${file}"}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                        <button class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection