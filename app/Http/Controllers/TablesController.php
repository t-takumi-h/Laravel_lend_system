<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Table;
use App\Http\Requests\Tables\CreateRequest;

class TablesController extends Controller
{
    public function showTableCreationForm()
    {
        return view('tables.table_creation_form')->with('user', Auth::user());
    }

    public function createTable(CreateRequest $request)
    {
        $user = Auth::user();

        $table = new Table();
        $table->title = $request->title;
        $table->author_id = $user->id;
        $table->save();

        return redirect()->back();
    }

}
