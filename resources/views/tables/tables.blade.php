@extends('layouts.app')

@section('content')
<div>管理テーブル一覧</div>
<a href="{{ route('table.create') }}">管理テーブルの新規作成</a>
<div>
  @foreach ($tables as $table)
    <div>
      <a href="{{route('item.list', [$table->id])}}">{{ $table->title }}</a>
    </div>
  @endforeach
</div>
@endsection