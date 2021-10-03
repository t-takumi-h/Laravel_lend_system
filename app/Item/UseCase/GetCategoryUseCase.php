<?php

namespace App\Item\UseCase;

use App\Models\Category;
use App\Models\Table;

final class GetCategoryUseCase
{
  public function handle(Table $table)
  {
    $categories = Category::where('table_id',$table->id)->get();
    return $categories;
  }
}