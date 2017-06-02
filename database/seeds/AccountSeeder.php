<?php

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
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
                    'name' => 'Savings',
                    'description' => 'This is savings account.'
                ],
                [
                    'name' => 'Checking',
                    'description' => 'This is checking account.'
                ],
            ]
        )->each(
            function ($values) {
                Account::create($values);
            }
        );
    }
}
