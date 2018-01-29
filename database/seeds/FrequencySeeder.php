<?php

use App\Models\Transaction\Frequency;
use Illuminate\Database\Seeder;

class FrequencySeeder extends Seeder
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
                    'name' => 'Once',
                    'description' => 'This is used for adhoc transactions.'
                ],
                [
                    'name' => 'Weekly',
                    'description' => 'This is used for repeating transactions on a per week basis.'
                ],
                [
                    'name' => 'Bi-weekly',
                    'description' => 'This is used for repeating transactions on a bi-weekly basis.'
                ],
                [
                    'name' => 'Semi-Monthly',
                    'description' => 'This is used for repeating transactions on a semi-monthly basis.'
                ],
                [
                    'name' => 'Monthly',
                    'description' => 'This is used for repeating transactions on a monthly basis.'
                ],
                [
                    'name' => 'Annual',
                    'description' => 'This is used for repeating transactions on an annual basis.'
                ]
            ]
        )->each(
            function ($values) {
                Frequency::create($values);
            }
        );
    }
}
