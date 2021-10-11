@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form-inline p-2" method="POST" action="{{ route('item.list', [$table->id] ) }}">
      @csrf
      <div class="form-group mr-3">
        <input type="text" class="form-control @error('search') is-invalid @enderror" name="search" id="search" value="{{$search ?? ''}}" />
        @error('search')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="mr-3">
        <button type="submit" class="btn btn-primary">検索</button>
      </div>
    </form>
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
          <a href="{{ route('item.lend-list', [$table->id]) }}" class="btn btn-primary mr-3">貸出一覧</a>
          <a href="{{ route('item.qrcode', [$table->id]) }}" class="btn btn-primary">QRコード一覧</a>
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

        @if ($item->state == App\Models\Item::STATE_AVAILABLE)
        <td><span class="badge badge-success">{{ $item->state }}</span></td>
        @else
        <td><span class="badge badge-danger">{{ $item->state }}</span></td>
        @endif
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