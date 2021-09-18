@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <form class="" method="POST" action="{{ route('return') }}">
    @csrf
      <div class="card-header">
        <div class="row">
          <div class="col-sm-6 d-flex align-items-center font-weight-bold">
            {{ Auth::user()->name }}さんの貸出一覧
          </div>
          <div class="col-sm-6 d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-danger">返却する</button>
          </div>
        </div>
      </div>
      <table class="table">
        <tr>
          <th>テーブル名</th>
          <th>備品名</th>
          <th>貸出日</th>
          <th>返却予定日</th>
          <th>返却</th>
        </tr>
        @foreach ($lend_logs as $lend_log)
        <tr>
          <td>{{ $lend_log->item->table->title }}</td>
          <td>{{ $lend_log->item->name }}</td>
          <td>{{ $lend_log->borrow_at }}</td>
          <td>{{ $lend_log->return_expect }}</td>
          <td><input type="checkbox" name="return_log[{{ $lend_log->id }}]" value="1"></td>
        </tr>
        @endforeach
      </table>
      <div class="card-footer">
        <a href="{{ route('top') }}">備品テーブル一覧に戻る</a>
      </div>
    </form>
  </div>
</div>
@endsection