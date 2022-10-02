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
        <p>{{ $name }}</p>
    </body>
</html>