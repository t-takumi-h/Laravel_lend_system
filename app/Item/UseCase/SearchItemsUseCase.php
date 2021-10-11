<?php

namespace App\Item\UseCase;

use App\Models\Item;
use App\Models\Table;
use App\Http\Requests\Items\SearchRequest;

final class SearchItemsUseCase
{
  public function handle(SearchRequest $request, Table $table)
  {
    $items = Item::where('table_id', $table->id)
            ->where('name', 'LIKE', "%{$request->search}%")
            ->orwhere('part_num', 'LIKE', "%{$request->search}%")
            ->orwhere('vendor', 'LIKE', "%{$request->search}%")
            ->with('category') //Eager Loadingでクエリ回数を減らす
            ->paginate(5);
    return $items;
  }
}