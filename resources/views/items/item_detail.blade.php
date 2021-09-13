@extends('layouts.app')

@section('content')
<div>"{{ $item->name }}"の詳細</div>
<div>品名：{{ $item->name }}</div>
<div>型名：{{ $item->part_num }}</div>
<div>メーカー名：{{ $item->vendor }}</div>
<div>カテゴリー：{{ $item->category->name }}</div>
<div>ステータス：{{ $item->state }}</div>
<br>
<div>
  @if ($item->state === App\Models\Item::STATE_AVAILABLE)
  @auth
  貸出申請をする場合は返却予定日を入力してください。
  <div>
    <form method="POST" action="{{ route('item.detail', [$table->id, $item->id]) }}">
      @csrf
      <div>
        <label for="name">返却予定日</label>
        <input type="date" name="return_expect" id="return_expect" min="{{ date('Y-m-d') }}" value="{{ old('return_expect')}}" required />
      </div>
      <div>
        <button type="submit">申請</button>
      </div>
    </form>
  </div>
  @endauth
  @guest
  <div><a href="{{ route('login') }}">ログインして貸出申請</a></div>
  @endguest
  @else
  <div>貸出中のため貸出申請できません</div>
  @endif
</div>
@if (session('test'))
{{ session('test') }}
@endif
<br>
<div>
  <table>
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
@endsection