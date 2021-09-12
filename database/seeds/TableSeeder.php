<?php

use Illuminate\Database\Seeder;
use App\Models\Table;
use App\Models\Category;
use App\Models\Item;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Table::class, 2)->create()
            ->each(function ($table)
            {
                $table->categories()->saveMany(
                    factory(Category::class, 5)->make()
                    )
                    ->each(function ($category)
                    {
                        $category->items()->saveMany(
                            factory(Item::class, 2)->make(
                                ['table_id' => $category->table_id]
                            )
                        );
                    }
                );
            });
    }
}
