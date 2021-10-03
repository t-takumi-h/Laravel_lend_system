<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Category;
use App\Models\LendLog;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Items\CreateRequest;
use App\Http\Requests\LendLogs\LendLogRequest;
use App\Item\UseCase\GetCategoryUseCase;
use App\Item\UseCase\ShowItemsUseCase;
use App\Item\UseCase\EditItemUseCase;
use App\Item\UseCase\CreateItemUseCase;

class ItemsController extends Controller
{
    public function showItems(Table $table, ShowItemsUseCase $useCase)
    {
        $items = $useCase->handle($table);

        return view('items.items')->with([
            'items' => $items,
            'table' => $table,
        ]);
    }

    public function showItemDetail(Table $table, Item $item)
    {
        $lend_logs = LendLog::where('item_id', $item->id)
            ->orderBy('id','desc')
            ->with('borrower')
            ->get();

        return view('items.item_detail')->with([
            'table'     => $table,
            'item'      => $item,
            'lend_logs' => $lend_logs,
        ]);
    }

    public function showItemCreationForm(Table $table, GetCategoryUseCase $useCase)
    {
        $categories = $useCase->handle($table);
        return view('items.item_creation_form')->with([
            'table'         => $table,
            'categories'    => $categories,
        ]);
    }

    public function showItemEditingForm(Table $table, Item $item, GetCategoryUseCase $useCase)
    {
        $categories = $useCase->handle($table);
        return view('items.item_editing_form')->with([
            'table'         => $table,
            'item'          => $item,
            'categories'    => $categories,
        ]);
    }

    public function createItem(CreateRequest $request, Table $table, CreateItemUseCase $useCase)
    {
        $useCase->handle($request, $table);
        return redirect()->back();
    }

    public function editItem(CreateRequest $request, Table $table, Item $item, EditItemUseCase $useCase)
    {
        $useCase->handle($request, $item);
        return redirect()->back();
    }

    public function lendItem(LendLogRequest $request, Table $table, Item $item)
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

        return redirect()->back();
    }
    
}
