@extends('layouts.default')
@section('title', 'お問い合わせ確認')

@section('content')

<section>

    <div>
        <label>お名前</label>
        {{ $data['name'] }}
    </div>

    <div>
        <label>フリガナ</label>
        {{ $data['kana_name'] }}
    </div>

    <div>
        <label>性別</label>
        {{ $data['sex_id'] }}
    </div>

    <div>
        <label>生年月日</label>
        {{ sprintf('%d年%d月%d日', $data['birthday_year'], $data['birthday_month'], $data['birthday_day']) }}
    </div>
    
    <div>
        <label>メールアドレス</label>
        {{ $data['email'] }}
    </div>

    <div>
        <label>電話番号</label>
        {{ $data['phone'] }}
    </div>

    <div>
        <label>希望勤務地</label>
        {{ $data['job_prefecture_id'] }}
    </div>

    <div>
        <label>希望職種</label>
        {{ $data['job_type_id'] }}
    </div>

    <div>
        <label>お問い合わせ内容</label>
        {{ $data['body'] }}
    </div>

    <div>
        <form action="{{ route('entries.index') }}" method="POST">
            @csrf
            
            <button type="submit" name="submitBtnVal" value="戻る">戻る</button>
        </form>

        <form action="{{ route('entries.thanks') }}" method="POST">
            @csrf
            <button type="submit" name="submitBtnVal" value="complete">送信</button>
        </form>

    </div>

</section>
@endsection
