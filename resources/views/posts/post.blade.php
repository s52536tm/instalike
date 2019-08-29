@extends('layouts.post_layout')
@extends('layouts.header_layout')

@section('content')
    <h2>画像のアップロード</h2><br>

    <form method="post" action="{{ action('PostController@store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

    <div class="button_wrapper">
        <fieldset>
        <legend>投稿画像の選択</legend>
            <p>
                <input type="file" id="myfile" name="image" accept="image/png,image/jpg,image/gif/"><br>
                <img id="img" style="width:300px;height:300px;" />
                <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
                <script>
                    $(function(){
                        $('#myfile').change(function(e){
                            //ファイルオブジェクトを取得する
                            var file = e.target.files[0];
                            var reader = new FileReader();
                            
                            //画像でない場合は処理終了
                            if(file.type.indexOf("image") < 0){
                                alert("画像ファイルを指定してください。");
                                return false;
                            }
                            
                            //アップロードした画像を設定する
                            reader.onload = (function(file){
                                return function(e){
                                    $("#img").attr("src", e.target.result);
                                    $("#img").attr("title", file.name);
                                };
                            })(file);
                        reader.readAsDataURL(file);
                        });
                    });
                </script>

                @if ($errors->has('image'))
                    {{ $errors->first('image') }}
                @endif
            </p>
        </fieldset>

        <fieldset>
        <legend>キャプションの入力(最大200文字)</legend>
            <p>
                <textarea name="caption" rows="5" cols="40"></textarea>
            </p>
        </fieldset>
            <input class="btn btn-primary" type="submit" value="アップロード" />
    </div>
    </form>
@endsection