
@extends('layouts.default')
@section('title', '新規登録')

@section('content')
<section>
    <h1>新規登録</h1>
    <form action="" method="post">
        @csrf
        <label for="name">名前</label>
        <input type="text" name="name" id="name">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email">
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password">
        <button type="submit">送信</button>
    </form>
</section>
@endsection