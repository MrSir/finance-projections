<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysAccountTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_transactions', function ($table) {
            $table->foreign('from_account_id')
                ->references('id')
                ->on('accounts')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

            $table->foreign('to_account_id')
                ->references('id')
                ->on('accounts')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_transactions', function ($table) {
            $table->dropForeign('account_transactions_from_account_id_foreign');
            $table->dropForeign('account_transactions_to_account_id_foreign');
            $table->dropForeign('account_transactions_transaction_id_foreign');
        });
    }
}
