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
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name')}}" />
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group mr-3">
          <label for="part_num">型名</label>
          <input type="text" class="form-control @error('part_num') is-invalid @enderror" name="part_num" id="part_num" value="{{ old('part_num')}}" />
          @error('part_num')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group mr-3">
          <label for="vendor">メーカー名</label>
          <input type="text" class="form-control @error('vendor') is-invalid @enderror" name="vendor" id="vendor" value="{{ old('vendor')}}" />
          @error('vendor')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
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
          @error('category')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
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