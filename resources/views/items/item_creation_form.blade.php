@extends('layouts.app')

@section('content')
<div>"{{ $table->title }}"に備品を追加する</div>
<form method="POST" action="{{ route('item.create', [$table->id] ) }}">
  @csrf
  <div>
    <label for="name">備品名</label>
    <input type="text" name="name" id="name" value="{{ old('name')}}" />
  </div>
  <div>
    <label for="part_num">型名</label>
    <input type="text" name="part_num" id="part_num" value="{{ old('part_num')}}" />
  </div>
  <div>
    <label for="vendor">メーカー名</label>
    <input type="text" name="vendor" id="vendor" value="{{ old('vendor')}}" />
  </div>
  <div>
    <label for="category">カテゴリー</label>
    <select name="category">
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
  <div>
    <button type="submit">追加</button>
  </div>
</form>
<a href="{{route('item.list', [$table->id])}}">備品一覧に戻る</a>
@endsection