<?php

namespace App\Item\UseCase;

use App\Models\Item;
use App\Models\Table;
use App\Http\Requests\Items\CreateRequest;

final class EditItemUseCase
{
  public function handle(CreateRequest $request, Item $item)
  {
    $item->name         = $request->name;
    $item->part_num     = $request->part_num;
    $item->vendor       = $request->vendor;
    $item->category_id  = $request->category;
    $item->save();
  }
}
