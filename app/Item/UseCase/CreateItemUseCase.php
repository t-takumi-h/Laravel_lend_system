<?php

namespace App\Item\UseCase;

use App\Models\Item;
use App\Models\Table;
use App\Http\Requests\Items\CreateRequest;

final class CreateItemUseCase
{
  public function handle(CreateRequest $request, Table $table)
  {
    $item               = new Item();
    $item->name         = $request->name;
    $item->part_num     = $request->part_num;
    $item->vendor       = $request->vendor;
    $item->table_id     = $table->id;
    $item->category_id  = $request->category;
    $item->state        = Item::STATE_AVAILABLE;
    $item->save();
  }
}
