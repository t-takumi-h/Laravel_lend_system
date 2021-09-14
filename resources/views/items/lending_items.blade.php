@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="d-flex align-items-center font-weight-bold">
        "{{ $table->title }}"の備品一覧
      </div>
    </div>
    <table class="table">
      <tr>
        <th>備品名</th>
        <th>貸出日</th>
        <th>貸与ユーザー</th>
        <th>返却予定日</th>
      </tr>
      @foreach ($lend_logs as $lend_log)
      <tr>
        <td>{{ $lend_log->item->name }}</td>
        <td>{{ $lend_log->borrow_at }}</td>
        <td>{{ $lend_log->borrower->name }}</td>
        <td>{{ $lend_log->return_expect }}</td>
      </tr>
      @endforeach
    </table>
    <div class="card-footer">
      <a href="{{ route('item.list', [$table->id]) }}">備品一覧に戻る</a>
    </div>
  </div>
</div>
  @endsection