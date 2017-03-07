<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function ($table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

            $table->foreign('transaction_frequency_id')
                ->references('id')
                ->on('transaction_frequencies')
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
        Schema::table('transactions', function ($table) {
            $table->dropForeign('transactions_category_id_foreign');
            $table->dropForeign('transactions_transaction_frequency_id_foreign');
        });
    }
}
