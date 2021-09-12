<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Table;
use Illuminate\Auth\Access\HandlesAuthorization;

class TablePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function itemCreate(User $user, Table $table)
    {
        return $user->id === $table->author_id;
    }
}
