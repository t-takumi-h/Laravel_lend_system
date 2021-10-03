<?php

namespace App\Item\UseCase;

use App\Models\Item;
use App\Models\Table;

final class ShowItemsUseCase
{
  public function handle(Table $table)
  {
    $items = Item::where('table_id', $table->id)
            ->with('category') //Eager Loadingでクエリ回数を減らす
            ->paginate(5);
    return $items;
  }
}