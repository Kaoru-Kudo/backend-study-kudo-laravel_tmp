
@extends('layouts.default')
@section('title', 'ログイン')

@section('content')
<section>
    <h1>ログイン</h1>
    <form action="" method="post">
        @csrf
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email">
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password">
        <button type="submit">送信</button>
    </form>
</section>
@endsection