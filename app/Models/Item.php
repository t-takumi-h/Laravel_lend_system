<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //貸出可能
    const STATE_AVAILABLE = '貸出可能';
    //貸出中
    const STATE_UNAVAILABLE = '貸出中';

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function table(){
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function lend_logs(){
        return $this->hasMany(LendLog::class, 'item_id');
    }


}
