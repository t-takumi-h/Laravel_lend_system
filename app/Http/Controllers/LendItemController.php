<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\LendLog;
use App\Models\Item;
use League\CommonMark\Extension\Table\TableExtension;

class LendItemController extends Controller
{
    public function showLendingItems(Table $table)
    {
        $lend_logs = Lendlog::where('was_returned', 0)
            ->with('borrower')
            ->with(['item' => function ($query) use ($table) {
                $query->where('table_id', $table->id);
            }])
            ->get();
        
        return view('items.lending_items')->with([
            'lend_logs' => $lend_logs,
            'table' => $table,
        ]); 
    }
}
