<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LendLog;
use App\Models\Item;
use App\Http\Requests\LendLogs\LendLogRequest;
use App\ReturnItem\UseCase\GetUserLendLogUseCase;
use App\ReturnItem\UseCase\ReturnUseCase;

class ReturnController extends Controller
{
    public function showReturnForm(GetUserLendLogUseCase $useCase)
    {
        $lend_logs = $useCase->handle();
        return view('return_form')->with('lend_logs', $lend_logs);
    }

    public function returnItem(Request $request, ReturnUseCase $useCase)
    {
        $useCase->handle($request);
        return redirect()->back();
    }
}
