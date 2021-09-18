<?php

use Illuminate\Database\Seeder;
use App\Models\Table;
use App\Models\Category;
use App\Models\Item;
use App\Models\LendLog;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Table::class, 2)->create()->each(
            function ($table)
            {
                $table->categories()->saveMany(
                    factory(Category::class, 5)->make()
                )->each(
                    function ($category)
                    {
                        $category->items()->saveMany(
                            factory(Item::class, 1)->make([
                                'table_id' => $category->table_id,
                        ]))->each(
                            function ($item)
                            {
                                $item->lend_logs()->saveMany(
                                    factory(LendLog::class, 2)->make([
                                        'borrower_id' => 1,
                                    ])
                                );
                                $item->lend_logs()->saveMany(
                                    factory(LendLog::class, 2)->make([
                                        'borrower_id' => 2,
                                    ])
                                );
                            }
                        );

                        $category->items()->saveMany(
                            factory(Item::class, 1)->make([
                                'table_id' => $category->table_id,
                                'state' => Item::STATE_UNAVAILABLE,
                        ]))->each(
                            function ($item)
                            {
                                $item->lend_logs()->saveMany(
                                    factory(LendLog::class, 2)->make([
                                        'borrower_id' => 1,
                                    ])
                                );
                                $item->lend_logs()->saveMany(
                                    factory(LendLog::class, 2)->make([
                                        'borrower_id' => 2,
                                    ])
                                );
                                $item->lend_logs()->saveMany(
                                    factory(LendLog::class, 1)->make([
                                        'borrow_at' => now(),
                                        'return_expect' => now()->format('Y-m-d'),
                                        'return_at' => null,
                                        'was_returned' => 0,
                                    ])
                                );
                                
                            }
                        );
                    }
                );
            }
        );
    }
}
