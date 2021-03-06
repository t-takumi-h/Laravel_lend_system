<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Category;
use App\Models\LendLog;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Items\CreateRequest;
use App\Http\Requests\Items\SearchRequest;
use App\Http\Requests\LendLogs\LendLogRequest;
use App\Item\UseCase\GetCategoryUseCase;
use App\Item\UseCase\ShowItemsUseCase;
use App\Item\UseCase\SearchItemsUseCase;
use App\Item\UseCase\EditItemUseCase;
use App\Item\UseCase\CreateItemUseCase;
use App\Item\UseCase\GetLendLogUseCase;
use App\Item\UseCase\LendItemUseCase;

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

    public function searchItems(SearchRequest $request, Table $table, SearchItemsUseCase $useCase)
    {
        $items = $useCase->handle($request,$table);

        return view('items.items')->with([
            'items' => $items,
            'table' => $table,
            'search'=> $request->search,
        ]);
    }

    public function showItemDetail(Table $table, Item $item, GetLendLogUseCase $useCase)
    {
        $lend_logs = $useCase->handle($item);

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

    public function showItemQrcode(Table $table, ShowItemsUseCase $useCase){
        $items = $useCase->handle($table);

        return view('items.item_qrcodes')->with([
            'items' => $items,
            'table' => $table,
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

    public function lendItem(LendLogRequest $request, Table $table, Item $item, LendItemUseCase $useCase)
    {
        $useCase->handle($request, $item);
        return redirect()->back();
    }
    
}
