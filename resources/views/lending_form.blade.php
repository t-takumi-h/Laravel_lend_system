@extends('layouts.app')

@section('content')
<div>{{ $item->name }}の貸出申請</div>
<form method="POST" action="{{ route('table.create') }}">
  @csrf
  <div>
    <label for="title">管理テーブル名</label>
    <input type="text" name="title" id="title" value="{{ old('title')}}" />
  </div>
  <dib>
    <button type="submit">作成</button>
  </dib>
</form>
@endsection