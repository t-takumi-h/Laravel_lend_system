<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LendLog extends Model
{
    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }
}
