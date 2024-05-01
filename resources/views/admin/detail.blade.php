@extends('layouts.default')
@section('title', '管理画面：詳細')

@section('content')
<section>
    <p>
        {{\Illuminate\Support\Facades\Auth::user()['name']}}でログインしています。
    </p>

    <form action="{{route('user.logout')}}" method="post">
        @csrf
        <button>ログアウト</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>名前（カナ）</th>
                <th>性別</th>
                <th>誕生日</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
                <th>希望勤務地</th>
                <th>希望職種</th>
                <th>お問い合わせ内容</th>
                <th>追加日</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $entry['id'] }}</td>
                <td>{{ $entry['name'] }}</td>
                <td>{{ $entry['kana_name'] }}</td>
                <td>{{ $entry['sex_id'] }}</td>
                <td>{{ $entry['birthday'] }}</td>
                <td>{{ $entry['email'] }}</td>
                <td>{{ $entry['phone'] }}</td>
                <td>{{ $entry['job_prefecture_id'] }}</td>
                <td>{{ $entry['job_type_id'] }}</td>
                <td>{{ $entry['body'] }}</td>
                <td>{{ $entry['created_at'] }}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection