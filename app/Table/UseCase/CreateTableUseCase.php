<?php

namespace App\Table\Usecase;

use Illuminate\Support\Facades\Auth;
use App\Models\Table;

final class CreateTableUseCase
{
  public function handle(string $title): void
  {
    $user               = Auth::user();
    $table              = new Table();

    $table->title       = $title;
    $table->author_id   = $user->id;
    $table->save();
  }
}
