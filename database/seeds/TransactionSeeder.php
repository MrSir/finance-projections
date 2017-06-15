<?php

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Transaction\Frequency;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Class TransactionSeeder
 */
class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(
            [
                [
                    'account_id' => Account::whereName('Checking')->first()->id,
                    'category_id' => Category::whereName('Home Expenses')->first()->id,
                    'transaction_frequency_id' => Frequency::whereName('Once')->first()->id,
                    'name' => 'Mortgage',
                    'description' => 'Where the money goes.',
                    'is_debit' => true,
                    'amount' => -1600,
                    'occurred_at' => Carbon::now(),
                ],
            ]
        )->each(
            function ($values) {
                Transaction::create($values);
            }
        );
    }
}
