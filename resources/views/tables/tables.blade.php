@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-8 d-flex align-items-center font-weight-bold">管理テーブル一覧</div>
        <div class="col-sm-4 d-flex align-items-center justify-content-end">
          <a href="{{ route('table.create') }}" class="btn btn-primary">
            新規作成
          </a>
        </div>
      </div>
    </div>
    <ul class="list-group list-group-flush">
      @foreach ($tables as $table)
      <li class="list-group-item">
        <a href="{{route('item.list', [$table->id])}}">{{ $table->title }}</a>
      </li>
      @endforeach
    </ul>
  </div>
</div>
@endsection