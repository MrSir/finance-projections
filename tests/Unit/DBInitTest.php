<?php

namespace App\Tests\Unit;

use DB;
use App\Tests\TestCase;

/**
 * Class Format
 * @package App\Tests\Unit
 */
class DBInitTest extends TestCase
{
    /**
     * @group DB.Init
     */
    public function testDBInit()
    {
        // reset mysql db
        DB::connection()
            ->getPdo()
            ->exec("DROP DATABASE IF EXISTS `finance_projections`;");

        DB::connection()
            ->getPdo()
            ->exec("CREATE SCHEMA `finance_projections`;");

        DB::connection()
            ->getPdo()
            ->exec("USE `finance_projections`;");

        $this->artisan('migrate');
        $this->artisan('db:seed');
        $this->artisan('db:seed', ['--class' => 'AccountSeeder']);
        $this->artisan('db:seed', ['--class' => 'TransactionSeeder']);

        $this->assertTrue(true);
    }
}
