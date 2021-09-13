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

class ItemsController extends Controller
{
    public function showItems(Table $table)
    {
        $items = Item::where('table_id', $table->id)
            ->with('category') //Eager Loadingでクエリ回数を減らす
            ->get();

        return view('items.items')->with([
            'items' => $items,
            'table'=> $table,
        ]);
    }

    public function showItemDetail(Table $table, Item $item)
    {
        $lend_logs = LendLog::where('item_id', $item->id)->latest()->get();
        return view('items.item_detail')->with([
            'table' => $table,
            'item' => $item,
            'lend_logs' => $lend_logs,
        ]);
    }

    public function showItemCreationForm(Table $table)
    {
        $user = Auth::user();
        if ($user->id !== $table->author_id)
        { 
            abort(403);
        }
        $categories = Category::where('table_id',$table->id)->get();
        return view('items.item_creation_form')->with([
            'table' => $table,
            'categories' => $categories,
        ]);
    }

    public function createItem(CreateRequest $request, Table $table)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->part_num = $request->part_num;
        $item->vendor = $request->vendor;
        $item->table_id = $table->id;
        $item->category_id = $request->category;
        $item->state = Item::STATE_AVAILABLE;
        $item->save();

        return redirect()->back();
    }

    public function lendItem(LendLogRequest $request, Table $table, Item $item)
    {
        $user = Auth::user();
        $lend_log = new LendLog();
        $lend_log->item_id = $item->id;
        //$lend_log->item_id = 1;
        $lend_log->borrower_id = $user->id;
        $lend_log->borrow_at = now();
        $lend_log->return_expect = $request->return_expect;
        $lend_log->was_returned = false;
        $lend_log->save();
        
        $item->state = Item::STATE_UNAVAILABLE;
        $item->save();

        return redirect()->back();
    }
}
