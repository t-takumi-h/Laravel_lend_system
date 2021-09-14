@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header font-weight-bold">"{{ $item->name }}"の詳細</div>
    <table class="table">
      <tr>
        <td>品名:</td>
        <td>{{ $item->name }}</td>
      </tr>
      <tr>
        <td>型名:</td>
        <td>{{ $item->part_num }}</td>
      </tr>
      <tr>
        <td>メーカー名:</td>
        <td>{{ $item->vendor }}</td>
      </tr>
      <tr>
        <td>カテゴリー:</td>
        <td>{{ $item->category->name }}</td>
      </tr>
      <tr>
        <td>ステータス:</td>
        <td>{{ $item->state }}</td>
      </tr>
    </table>
    <div class="card-footer">
      <a href="{{ route('item.list', [$table->id]) }}">備品一覧に戻る</a>
    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header font-weight-bold">貸出申請</div>
    <div class="card-body">
      @if ($item->state === App\Models\Item::STATE_AVAILABLE)
      @auth
      <p>貸出申請をする場合は返却予定日を入力してください。</p>
      <div>
        <form class="form-inline" method="POST" action="{{ route('item.detail', [$table->id, $item->id]) }}">
          @csrf
          <div class="form-group mr-3">
            <label for="name">返却予定日</label>
            <input type="date" class="form-control" name="return_expect" id="return_expect" min="{{ date('Y-m-d') }}" value="{{ old('return_expect')}}" required />
          </div>
          <button type="submit" class="btn btn-primary">申請</button>
        </form>
      </div>
      @endauth
      @guest
      <div><a href="{{ route('login') }}">ログイン</a>して貸出申請する</div>
      @endguest
      @else
      <p>貸出中のため貸出申請できません</p>
      @endif
    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header font-weight-bold">"{{ $item->name }}"の貸出履歴</div>
    <table class="table">
      <tr>
        <th>貸出日</th>
        <th>貸与ユーザー</th>
        <th>返却予定日</th>
        <th>返却日</th>
        <th>返却状態</th>
      </tr>
      @foreach ($lend_logs as $lend_log)
      <tr>
        <td>{{ $lend_log->borrow_at }}</td>
        <td>{{ $lend_log->borrower->name }}</td>
        <td>{{ $lend_log->return_expect }}</td>
        <td>{{ $lend_log->return_at }}</td>
        <td>{{ $lend_log->was_returned }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection