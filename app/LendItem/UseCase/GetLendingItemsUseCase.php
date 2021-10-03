<?php

namespace App\LendItem\UseCase;

use App\Models\LendLog;
use App\Models\Table;

final class GetLendingItemsUseCase
{
  public function handle(Table $table)
  {
    $lend_logs = Lendlog::where('was_returned', 0)
            ->join('items', 'lend_logs.item_id', 'items.id')
            ->where('table_id', $table->id)
            ->with('borrower')
            ->with('item')
            ->get();
    return $lend_logs;
  }
}