@extends('layouts.app')

@section('content')
<div>"{{ $table->title }}"の備品一覧</div>
<div>
  <table>
    <tr>
      <th>No.</th>
      <th>品名</th>
      <th>型名</th>
      <th>メーカー名</th>
      <th>カテゴリー</th>
    </tr>
    @foreach ($items as $item)
      <tr>
        <td>{{ $item->id }}</td>
        <td><a href="#">{{ $item->name }}</a></td>
        <td>{{ $item->part_num }}</td>
        <td>{{ $item->vendor }}</td>
        @if (isset($item->category_id))
          <td>{{ $item->category->name }}</td>
        @else
          <td>(カテゴリー未設定)</td>
        @endif
      </tr>
    @endforeach
  </table>
</div>
@endsection