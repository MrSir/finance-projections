<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                    'name' => 'Transfer',
                    'description' => 'This category is used for transactions that are transfers between accounts.'
                ],
                [
                    'name' => 'Income',
                    'description' => 'This category is used for transactions that are income related.'
                ],
                [
                    'name' => 'Home Expenses',
                    'description' => 'This category is used for transactions that are part of home expenses.'
                ],
                [
                    'name' => 'Automobile Expenses',
                    'description' => 'This category is used for transactions that are part of auto expenses.'
                ],
                [
                    'name' => 'Birthday/Anniversary',
                    'description' => 'This category is used for transactions that are part of birthdays/anniversaries.'
                ]
            ]
        )->each(
            function ($values) {
                Category::create($values);
            }
        );
    }
}
