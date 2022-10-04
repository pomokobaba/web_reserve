<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta 
            name="viewport" 
            content="width=device-width, user-scalable=no, initial-scale=1"
        >
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>つぶやきアプリ</title>
    </head>
    <body>
        <h1>つぶやきアプリ</h1>
        <div>
            <p>投稿フォーム</p>
            {{-- form内にあるデータの送信先の指定と、送信するHTTPのメソッドを定義。
                Routで名前を付けたので、routeヘルパーにその名前を指定することで対応したURLのバスを設定できる。 --}}
            <form action="{{ route('tweet.create') }}" method="post">
                @csrf
                <label for="tweet-content">つぶやき</label>
                <span>140文字まで</span>
                <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力"></textarea>
                {{-- バリデーションに失敗したらエラーを返す --}}
                @error('tweet')
                <p style="color: red;">{{ $message }}</p>
                @enderror
                <button type="submit">投稿</button>
            </form>
        </div>
        <div>
            @foreach($tweets as $tweet)
                <p>{{ $tweet->content }}</p>
            @endforeach
            </div>
    </body>
</html>