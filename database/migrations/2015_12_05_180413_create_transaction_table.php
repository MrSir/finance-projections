<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->enum('type', ['expense', 'saving']);

            $table->string('name');
            $table->string('description');
            $table->float('amount',10, 2);
            $table->date('date');

            $table->enum('frequency', ['once', 'weekly', 'biweekly', 'monthly', 'annual']);
            $table->date('repeat_start');
            $table->date('repeat_end');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
