@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header font-weight-bold">管理テーブルを作成する</div>
    <div class="card-body">
      <form class="" method="POST" action="{{ route('table.create') }}">
        @csrf
        <div class="form-group mr-3">
          <label for="title">管理テーブル名</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title')}}" />
          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <dib>
          <button type="submit" class="btn btn-primary">作成</button>
        </dib>
      </form>
    </div>
    <div class="card-footer">
      <a href="{{ route('top') }}">管理テーブル一覧に戻る</a>
    </div>
  </div>
</div>
@endsection