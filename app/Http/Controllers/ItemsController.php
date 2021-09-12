<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Items\CreateRequest;

class ItemsController extends Controller
{
    public function showItems(Table $table)
    {
        $items = Item::where('table_id', $table->id)
            ->with('category') //Eager Loadingでクエリ回数を減らす
            ->get();

        return view('items.items')->with('items', $items)->with('table', $table);
    }

    public function showItemCreationForm(Table $table)
    {
        $user = Auth::user();
        if ($user->id !== $table->author_id)
        { 
            abort(403);
        }
        $categories = Category::where('table_id',$table->id)->get();
        return view('items.item_creation_form')->with('table', $table)->with('categories', $categories);
    }

    public function createItem(CreateRequest $request, Table $table)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->part_num = $request->part_num;
        $item->vendor = $request->vendor;
        $item->table_id = $table->id;
        $item->category_id = $request->category;
        $item->save();

        return redirect()->back();
    }
}
