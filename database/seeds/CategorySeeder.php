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
                    'description' => ''
                ],
                [
                    'name' => 'Home Expenses',
                    'description' => ''
                ],
                [
                    'name' => 'Automobile Expenses',
                    'description' => ''
                ],
                [
                    'name' => 'Birthday/Anniversary',
                    'description' => ''
                ]
            ]
        )->each(
            function ($values) {
                Category::create($values);
            }
        );
    }
}
