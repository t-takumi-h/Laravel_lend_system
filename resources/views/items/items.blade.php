@extends('layouts.app')

@section('content')
<div>"{{ $table->title }}"の備品一覧</div>
@auth
  @if (Auth::user()->id === $table->author_id)
    <a href="{{ route('item.create', [$table->id]) }}">備品の新規作成</a><br>
  @endif
@endauth
<div>
  <table>
    <tr>
      <th>No.</th>
      <th>品名</th>
      <th>型名</th>
      <th>メーカー名</th>
      <th>カテゴリー</th>
      <th>ステータス</th>
    </tr>
    @foreach ($items as $item)
      <tr>
        <td>{{ $item->id }}</td>
        <td><a href="{{ route('item.detail', [$table->id, $item->id]) }}">{{ $item->name }}</a></td>
        <td>{{ $item->part_num }}</td>
        <td>{{ $item->vendor }}</td>
        @if (isset($item->category_id))
          <td>{{ $item->category->name }}</td>
        @else
          <td>(カテゴリー未設定)</td>
        @endif
        <td>{{ $item->state }}</td>
      </tr>
    @endforeach
  </table>
</div>
<a href="{{ route('top') }}">管理テーブル一覧に戻る</a>
@endsection