<?php

namespace App\Item\UseCase;

use App\Models\LendLog;
use App\Models\Item;

final class GetLendLogUseCase
{
  public function handle(Item $item)
  {
    $lend_logs = LendLog::where('item_id', $item->id)
            ->orderBy('id','desc')
            ->with('borrower')
            ->get();
    return $lend_logs;
  }
}