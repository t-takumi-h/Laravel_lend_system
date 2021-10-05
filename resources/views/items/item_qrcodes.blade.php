@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-6 d-flex align-items-center font-weight-bold">
          "{{ $table->title }}"の備品QRコード一覧
        </div>
      </div>
    </div>
    @foreach ($items as $item)
    <div class="d-inline-flex flex-row p-2 .d-sm-inline-flex bd-highlight">
      <div class="p-2 bd-highlight">
      {{ QrCode::size(180)->generate(route('item.detail', [$table->id, $item->id])) }}
      </div>
      <div class="p-2 bd-highlight">
        <p>No. : {{ $item->id }}</p>
        <p>品名 : {{ $item->name }}</p>
        <p>型名 : {{ $item->part_num }}</p>
        <p>メーカー名 : {{ $item->vendor }}</p>
        @if (isset($item->category_id))
        <p>カテゴリー : {{ $item->category->name }}</p>
        @else
        <p>カテゴリー : 未設定</p>
        @endif
      </div>
    </div>
    @endforeach
    <div class="card-footer">
      <div class="row">
        <a href="{{route('item.list', [$table->id])}}" class="col-sm-6 d-flex align-items-center">管理テーブル一覧に戻る</a>
        <div class="col-sm-6 d-flex align-items-center justify-content-end">
          {{ $items->withQueryString()->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection