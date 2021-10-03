<?php

namespace App\Http\Controllers;

use App\LendItem\UseCase\GetLendingItemsUseCase;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\LendLog;
use App\Models\Item;
use League\CommonMark\Extension\Table\TableExtension;

class LendItemController extends Controller
{
    public function showLendingItems(Table $table, GetLendingItemsUseCase $useCase)
    {
        $lend_logs = $useCase->handle($table);
        
        return view('items.lending_items')->with([
            'lend_logs' => $lend_logs,
            'table' => $table,
        ]); 
    }
}
