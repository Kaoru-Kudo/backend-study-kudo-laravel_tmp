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
            <label for="name">お名前<span>必須</span></label>
            <input id="name" type="text" name="name" value="{{ $data->get('name') ?? old('name') }}">
            @if($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div>
            <label for="kana_name">フリガナ<span>必須</span></label>
            <input id="kana_name" type="text" name="kana_name" value="{{ $data->get('kana_name') ?? old('kana_name') }}">
            @error('kana_name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="kana_name">性別<span>必須</span></label>
            <div class="form_radio_box">
                <input type="radio" name="sex_id" value="1" {{ $data->get('sex_id') === "1" || old("sex_id") === "1" ? 'checked' : '' }}> 男性
            </div>
            <div class="form_radio_box">
                <input type="radio" name="sex_id" value="2" {{ $data->get('sex_id') === "2" || old("sex_id") === "2" ? 'checked' : '' }}> 女性
            </div>
            @error('sex_id')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>生年月日<span>必須</span></label>
            <div class="form_birth01">
                <select class="form_birth_box" name="birthday_year" data-trigger-selectbox="select">
                    <option value="">--</option>
                    @foreach($years as $key => $year)
                        <option value="{{ $key }}" {{ $key === (int) old('birthday_year') || $key === (int) $data->get('birthday_year') ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>  
            <div class="form_birth01">
                <select class="form_birth_box" name="birthday_month" data-trigger-selectbox="select">
                    <option value="">--</option>
                    @foreach($months as $key => $month)
                        <option value="{{ $key }}" {{ $key === (int) old('birthday_month') || $key === (int) $data->get('birthday_month') ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form_birth01">
                <select class="form_birth_box" name="birthday_day" data-trigger-selectbox="select">
                    <option value="">--</option>
                    @foreach($days as $key => $day)
                        <option value="{{ $key }}" {{ $key === (int) old('birthday_day') || $key === (int) $data->get('birthday_day') ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
            </div>
            @error('birthday_year')
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
            <label for="phone">電話番号</label>
            <input id="phone" type="text" name="phone" value="{{ $data->get('phone') ?? old('phone') }}">
            @error('phone')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form_wish01">
            <label>希望勤務地<span>必須</span></label>
            <select class="form_wish_box" name="job_prefecture_id" data-trigger-selectbox="select">
            <option value="">選択してください</option>
            @foreach($prefs as $key => $pref)
                <option value="{{ $key }}" {{ $key === (int) old('job_prefecture_id') || $key === (int) $data->get('job_prefecture_id') ? 'selected' : '' }}>{{ $pref }}</option>
            @endforeach
            </select>
        </div>

        <div class="form_wish01">
            <label>希望職種</label>
            <select class="form_wish_box" name="job_type_id" data-trigger-selectbox="select">
                <option value="">選択してください</option>
                @foreach($jobTypes as $key => $item)
                    <option value="{{ $key }}" {{ $key === (int) old('job_type_id') || $key === (int) $data->get('job_type_id') ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
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
