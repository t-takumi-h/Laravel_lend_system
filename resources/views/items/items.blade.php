@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-6 d-flex align-items-center font-weight-bold">
          "{{ $table->title }}"の備品一覧
        </div>
        <div class="col-sm-6 d-flex align-items-center justify-content-end">
          @auth
          @if (Auth::user()->id === $table->author_id)

          <a href="{{ route('item.create', [$table->id]) }}" class="btn btn-primary mr-3">新規作成</a>
          @endif
          @endauth
          <a href="{{ route('item.lend-list', [$table->id]) }}" class="btn btn-primary">貸出一覧</a>
        </div>
      </div>
    </div>
    <table class="table">
      <tr>
        <th>No.</th>
        <th>品名</th>
        <th>型名</th>
        <th>メーカー名</th>
        <th>カテゴリー</th>
        <th>ステータス</th>
      </tr>
      @foreach ($items as $item)
      <tr>
        <td>{{ $item->id }}</td>
        <td><a href="{{ route('item.detail', [$table->id, $item->id]) }}">{{ $item->name }}</a></td>
        <td>{{ $item->part_num }}</td>
        <td>{{ $item->vendor }}</td>
        @if (isset($item->category_id))
        <td>{{ $item->category->name }}</td>
        @else
        <td>(カテゴリー未設定)</td>
        @endif
        <td>{{ $item->state }}</td>
      </tr>
      @endforeach
    </table>
    <div class="card-footer">
      <div class="row">
        <a href="{{ route('top') }}" class="col-sm-6 d-flex align-items-center">管理テーブル一覧に戻る</a>
        <div class="col-sm-6 d-flex align-items-center justify-content-end">
          {{ $items->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection