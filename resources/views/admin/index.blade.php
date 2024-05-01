@extends('layouts.default')
@section('title', '管理画面：一覧')

@section('content')
<section>
    <p>
        {{\Illuminate\Support\Facades\Auth::user()->name}}でログインしています。
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
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
            <tr>
                <td>{{ $entry['id'] }}</td>
                <td>{{ $entry['name'] }}</td>
                <td>{{ $entry['kana_name'] }}</td>
                <td><a href="{{ url('admin/detail/' . $entry['id']) }}">詳細</a></td>
                <td><a href="{{ url('admin/edit/' . $entry['id']) }}">編集</a></td>
                <td><div class="col-sm">
                    <form action="{{ url('admin/' . $entry['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('削除してもよろしいですか？');">Delete</button>
                    </form>
                </div></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection