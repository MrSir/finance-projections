<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
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
            $table->unsignedInteger('account_id')
                ->index('transactions_account_id_foreign');
            $table->unsignedInteger('destination_account_id')
                ->index('transactions_destination_account_id_foreign')
                ->nullable();
            $table->unsignedInteger('category_id')
                ->index('transactions_category_id_foreign');
            $table->unsignedInteger('transaction_frequency_id')
                ->index('transactions_transaction_frequency_id_foreign');

            $table->boolean('is_credit')->default(false);
            $table->boolean('is_debit')->default(false);

            $table->string('name');
            $table->string('description');
            $table->float('amount',10, 2);

            $table->dateTime('occurred_at');
            $table->dateTime('repeat_start_at')->nullable();
            $table->dateTime('repeat_end_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
