<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table){
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('table_id');
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables');
        });

        Schema::create('items', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('part_num');
            $table->string('vendor');
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('state');
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('lend_logs', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('borrower_id');
            $table->timestamp('borrow_at');
            $table->date('return_expect');
            $table->timestamp('return_at')->nullable();
            $table->boolean('was_returned');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('borrower_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lend_logs');
        Schema::dropIfExists('items');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tables');
    }
}
