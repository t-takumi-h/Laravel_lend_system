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
            <button type="submit" class="btn btn-danger" id="submit" disabled='disabled'>返却する</button>
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
          <td><input type="checkbox" class="chkbox" name="return_log[{{ $lend_log->id }}]" value="1"></td>
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

@section('scripts')
<script>
  let checkBoxs = document.getElementsByClassName('chkbox');
  let submit = document.getElementById('submit');
  for (let i = 0; i < checkBoxs.length; i++) {
    checkBoxs[i].addEventListener('change', function() {
        let ck_count = $(".table :checked").length;
        if (ck_count == 0) {
          submit.setAttribute('disabled', 'disabled');
        } else {
          submit.removeAttribute('disabled');
        }
      }
    );
  }
</script>
@endsection