<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Table;
use App\Http\Requests\Tables\CreateRequest;

//Tableに関する制御（CRUD）の正常動作に責任をもつ
class TablesController extends Controller
{
    //テーブルの一覧を表示する
    public function showTables()
    {
        $tables = Table::all();

        return view('tables.tables')->with('tables', $tables);
    }

    //テーブルの新規作成フォームを表示する
    public function showTableCreationForm()
    {
        return view('tables.table_creation_form');
    }

    //テーブルを新規作成する
    public function createTable(CreateRequest $request)
    {
        $user               = Auth::user();
        $table              = new Table();

        $table->title       = $request->title;
        $table->author_id   = $user->id;
        $table->save();

        return redirect()->route('top');
    }

}
