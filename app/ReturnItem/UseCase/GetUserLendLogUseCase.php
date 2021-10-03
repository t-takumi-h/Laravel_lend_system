<?php

namespace App\ReturnItem\UseCase;

use App\Models\LendLog;
use Illuminate\Support\Facades\Auth;

final class GetUserLendLogUseCase
{
  public function handle()
  {
    $user = Auth::user();
    $lend_logs = LendLog::where('borrower_id', $user->id)
      ->where('was_returned', 0)
      ->with(['item' => function ($query) {
        $query->with('table');
      }])
      ->get();
    return $lend_logs;
  }
}
