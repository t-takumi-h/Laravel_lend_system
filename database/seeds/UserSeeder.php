<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test1',
            'email' => 'test1@test.test',
            'password' => Hash::make('testtest'),
        ]);

        User::create([
            'name' => 'test2',
            'email' => 'test2@test.test',
            'password' => Hash::make('testtest'),
        ]);

        factory(User::class, 10)->create();
        
    }
}
