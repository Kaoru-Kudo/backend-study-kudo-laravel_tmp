@extends('layouts.default')
@section('title', 'お問い合わせ')

@section('content')

<section>

    @if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('example_form.confirm') }}" method="POST">
        @csrf

        <div>
            <label for="company">会社名<span>必須</span></label>
            <input id="company" type="text" name="company" value="{{ $data->get('company') ?? old('company') }}">
            @if($errors->has('company'))
            <p>{{ $errors->first('company') }}</p>
            @endif
        </div>

        <div>
            <label for="name">お名前<span>必須</span></label>
            <input id="name" type="text" name="name" value="{{ $data->get('name') ?? old('name') }}">
            @if($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div>
            <label for="name_kana">フリガナ<span>必須</span></label>
            <input id="name_kana" type="text" name="name_kana" value="{{ $data->get('name_kana') ?? old('name_kana') }}">
            @error('name_kana')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone">電話番号</label>
            <input id="phone" type="text" name="phone" value="{{ $data->get('phone') ?? old('phone') }}">
            @error('phone')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">メールアドレス<span>必須</span></label>
            <input id="email" type="text" name="email" value="{{ $data->get('email') ?? old('email') }}">
            @if($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div>
            <label for="email_confirmation">メールアドレスの確認<span>必須</span></label>
            <input id="email_confirmation" name="email_confirmation" value="{{ $data->get('email_confirmation') ?? old('email_confirmation') }}">
            @if($errors->has('email_confirmation'))
            <p>{{ $errors->first('email_confirmation') }}</p>
            @endif
        </div>

        <div>
            <label for="body">お問い合わせ内容<span>必須</span></label>
            <textarea id="body" type="text" name="body">{{ $data->get('body') ?? old('body') }}</textarea>
            @if($errors->has('body'))
            <p>{{ $errors->first('body') }}</p>
            @endif
        </div>

        <div>
            <button type="submit" name="submitBtnVal" value="確認">確認画面へ</button>
        </div>

    </form>
</section>
@endsection
