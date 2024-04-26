@extends('layouts.default')
@section('title', 'お問い合わせ確認')

@section('content')

<section>
    <div>
        <label for="company">会社名</label>
        {{ $data['company'] }}
    </div>

    <div>
        <label for="name">お名前</label>
        {{ $data['name'] }}
    </div>

    <div>
        <label for="name_kana">フリガナ</label>
        {{ $data['name_kana'] }}
    </div>

    <div>
        <label for="phone">電話番号</label>
        {{ $data['phone'] }}
    </div>

    <div>
        <label for="email">メールアドレス</label>
        {{ $data['email'] }}
    </div>

    <div>
        <label for="body">お問い合わせ内容</label>
        {{ $data['body'] }}
    </div>

    <div>
        <form action="{{ route('example_form.index') }}" method="POST">
            @csrf
            
            <button type="submit" name="submitBtnVal" value="戻る">戻る</button>
        </form>

        <form action="{{ route('example_form.thanks') }}" method="POST">
            @csrf
            <button type="submit" name="submitBtnVal" value="complete">送信</button>
        </form>

    </div>

</section>
@endsection
