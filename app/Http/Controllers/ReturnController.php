<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LendLog;
use App\Models\Item;
use App\Http\Requests\LendLogs\LendLogRequest;
use App\ReturnItem\UseCase\GetUserLendLogUseCase;

class ReturnController extends Controller
{
    public function showReturnForm(GetUserLendLogUseCase $useCase)
    {
        $lend_logs = $useCase->handle();
        return view('return_form')->with('lend_logs', $lend_logs);
    }

    public function returnItem(Request $request)
    {
        $checkbox_data = $request->all();
        $array_logs_id = array_keys($checkbox_data['return_log']);
        $lend_logs = LendLog::whereIn('id', $array_logs_id);
        $array_lend_logs = $lend_logs->get()->toArray();
        $array_items_id = array_column($array_lend_logs, 'item_id');


        $lend_logs->update([
            'was_returned' => 1,
            'return_at' => now(),
        ]);;
        $items = Item::whereIn('id', $array_items_id)->update([
            'state' => Item::STATE_AVAILABLE,
        ]);

        return redirect()->back();
    }
}
