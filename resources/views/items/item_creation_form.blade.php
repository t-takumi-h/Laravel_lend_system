@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header font-weight-bold">"{{ $table->title }}"に備品を追加する</div>
    <div class="card-body">
      <form class="" method="POST" action="{{ route('item.create', [$table->id] ) }}">
        @csrf
        <div class="form-group mr-3">
          <label for="name">備品名</label>
          <input type="text" class="form-control" ame="name" id="name" value="{{ old('name')}}" />
        </div>

        <div class="form-group mr-3">
          <label for="part_num">型名</label>
          <input type="text" class="form-control" name="part_num" id="part_num" value="{{ old('part_num')}}" />
        </div>

        <div class="form-group mr-3">
          <label for="vendor">メーカー名</label>
          <input type="text" class="form-control" name="vendor" id="vendor" value="{{ old('vendor')}}" />
        </div>

        <div class="form-group mr-3">
          <label for="category">カテゴリー</label>
          <select name="category" class="form-control">
            <option value="" {{ old('category') === "" ? 'select' : ''}}>
              カテゴリー選択なし
            </option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category') === $category->id ? 'select' : ''}}>
              {{ $category->name }}
            </option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">追加</button>
      </form>
    </div>
    <div class="card-footer">
      <a href="{{route('item.list', [$table->id])}}">備品一覧に戻る</a>
    </div>
  </div>
</div>
@endsection