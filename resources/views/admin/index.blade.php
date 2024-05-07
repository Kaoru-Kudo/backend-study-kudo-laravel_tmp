@extends('layouts.default')
@section('title', '管理画面：一覧')

@section('content')
<section>
    <p>
        {{ \Illuminate\Support\Facades\Auth::user()->name ?? 'ゲスト' }}でログインしています。
    </p>

    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button>ログアウト</button>
    </form>

    <form action="{{ route('admin.entries.index') }}" method="get">
        <label>キーワード</label>
        <input type="text" name="keyword" placeholder="名前・フリガナ検索" value="{{ request()->keyword ?? '' }}" >
        <label>希望勤務地</label>
        <select class="form_wish_box" name="job_prefecture_id" data-trigger-selectbox="select">
            <option value="">選択してください</option>
            @foreach($prefs as $key => $pref)
                <option value="{{ $key }}" {{ ($key === (int) old('job_prefecture_id') || $key === (int) (request()->get('job_prefecture_id') ?? 0)) ? 'selected' : '' }}>{{ $pref }}</option>
            @endforeach
        </select>
        <label>希望職種</label>
        <select class="form_wish_box" name="job_type_id" data-trigger-selectbox="select">
            <option value="">選択してください</option>
            @foreach($jobTypes as $key => $item)
                <option value="{{ $key }}" {{ ($key === (int) old('job_type_id') || $key === (int) (request()->get('job_type_id') ?? 0)) ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>
        <button type="submit">検索</button>
    </form>

    <div class="entries-info">
        <p>表示中: {{ $entries->firstItem() ?? '0' }} - {{ $entries->lastItem() ?? '0' }} 件 / 全 {{ $entries->total() ?? '0' }} 件</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>名前（カナ）</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($entries as $entry)
            <tr>
                <td>{{ $entry['id'] }}</td>
                <td>{{ $entry['name'] }}</td>
                <td>{{ $entry['kana_name'] }}</td>
                <td><a href="{{ route('admin.entries.show', $entry['id']) }}">詳細</a></td>
                <td><a href="{{ route('admin.entries.edit', $entry['id']) }}">編集</a></td>
                <td><div class="col-sm">
                    <form action="{{ route('admin.entries.destroy', $entry['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('削除してもよろしいですか？');">Delete</button>
                    </form>
                </div></td>
            </tr>
            @empty
            <tr>
                <td colspan="6">データがありません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{$entries->appends(request()->query())->links('vendor.pagination.bootstrap-4')}}

</section>
@endsection