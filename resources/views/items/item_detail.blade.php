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
        @if (isset($item->category_id))
        <td>{{ $item->category->name }}</td>
        @else
        <td>(カテゴリー未設定)</td>
        @endif
      </tr>
      <tr>
        <td>ステータス:</td>
        <td>{{ $item->state }}</td>
      </tr>
      @if ($item->state === App\Models\Item::STATE_UNAVAILABLE)
      <tr>
        <td>貸与ユーザー:</td>
        <td>{{ $lend_logs->first()->borrower->name }}</td>
      </tr>
      <tr>
        <td>返却予定日:</td>
        <td>{{ $lend_logs->first()->return_expect }}</td>
      </tr>
      @endif
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
            <label for="return_expect">返却予定日</label>
            <input type="date" class="form-control @error('return_expect') is-invalid @enderror" name="return_expect" id="return_expect" min="{{ date('Y-m-d') }}" value="{{ old('return_expect')}}" required />
            @error('return_expect')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
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
    <div class="card-header font-weight-bold">貸出履歴</div>
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
        @if ($lend_log->was_returned == 1)
        <td class="text-success">済</td>
        @else
        <td class="text-danger">未</td>
        @endif
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection