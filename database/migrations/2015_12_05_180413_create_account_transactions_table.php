<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from_account_id')
                ->index('account_transactions_from_account_id_foreign');
            $table->unsignedInteger('to_account_id')
                ->index('account_transactions_to_account_id_foreign');
            $table->unsignedInteger('transaction_id')
                ->index('account_transactions_transaction_id_foreign');

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
        Schema::drop('account_transactions');
    }
}
