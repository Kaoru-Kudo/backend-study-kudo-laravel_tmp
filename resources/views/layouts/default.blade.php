<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'フォーム')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
 
<body>
    <header>{{-- // header --}}</header>
 
    <main>@yield('content')</main>
 
    <footer>{{-- // footer  --}}</footer>
</body>
 
</html>