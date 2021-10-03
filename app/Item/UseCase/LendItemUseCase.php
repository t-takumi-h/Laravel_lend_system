<?php

namespace App\Item\UseCase;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\LendLog;
use App\Http\Requests\LendLogs\LendLogRequest;

final class LendItemUseCase
{
  public function handle(LendLogRequest $request, Item $item)
  {
    $user                       = Auth::user();
    $lend_log                   = new LendLog();
    $lend_log->item_id          = $item->id;
    $lend_log->borrower_id      = $user->id;
    $lend_log->borrow_at        = now();
    $lend_log->return_expect    = $request->return_expect;
    $lend_log->was_returned     = false;
    $lend_log->save();

    $item->state                = Item::STATE_UNAVAILABLE;
    $item->save();
  }
}
