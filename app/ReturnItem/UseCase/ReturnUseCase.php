<?php

namespace App\ReturnItem\UseCase;


use App\Models\Item;
use App\Models\LendLog;
use Illuminate\Http\Request;

final class ReturnUseCase
{
  public function handle(Request $request)
  {
    $checkbox_data = $request->all();
    $array_logs_id = array_keys($checkbox_data['return_log']);
    $lend_logs = LendLog::whereIn('id', $array_logs_id);
    $array_lend_logs = $lend_logs->get()->toArray();
    $array_items_id = array_column($array_lend_logs, 'item_id');


    $lend_logs->update([
      'was_returned' => 1,
      'return_at' => now(),
    ]);
    Item::whereIn('id', $array_items_id)->update([
      'state' => Item::STATE_AVAILABLE,
    ]);
  }
}
