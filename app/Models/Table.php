<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function categories(){
        return $this->hasMany(Category::class, 'table_id');
    }

    public function items(){
        return $this->hasMany(Item::class, 'table_id');
    }
}
