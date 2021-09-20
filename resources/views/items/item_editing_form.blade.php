@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header font-weight-bold">"{{ $item->name }}"を編集する</div>
    <div class="card-body">
      <form class="" method="POST" action="{{ route('item.edit', [$table->id, $item->id] ) }}">
        @csrf
        <div class="form-group mr-3">
          <label for="name">備品名</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $item->name)}}" />
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group mr-3">
          <label for="part_num">型名</label>
          <input type="text" class="form-control @error('part_num') is-invalid @enderror" name="part_num" id="part_num" value="{{ old('part_num', $item->part_num)}}" />
          @error('part_num')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group mr-3">
          <label for="vendor">メーカー名</label>
          <input type="text" class="form-control @error('vendor') is-invalid @enderror" name="vendor" id="vendor" value="{{ old('vendor', $item->vendor)}}" />
          @error('vendor')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group mr-3">
          <label for="category">カテゴリー</label>
          <select name="category" class="form-control">
            <option value="" {{ old('category', $item->category_id) == "" ? 'selected' : ''}}>
              カテゴリー選択なし
            </option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category', $item->category_id) === $category->id ? 'selected' : ''}}>
              {{ $category->name }}
            </option>
            @endforeach
          </select>
          @error('category')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">編集</button>
      </form>
    </div>
    <div class="card-footer">
      <a href="{{route('item.detail', [$table->id, $item->id])}}">備品詳細に戻る</a>
    </div>
  </div>
</div>
@endsection