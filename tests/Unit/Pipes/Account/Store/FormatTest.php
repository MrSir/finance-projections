<?php

namespace App\Tests\Unit\Pipes\Account\Store;

use App\Models\Account;
use App\Passables\Account\Store;
use App\Pipes\Account\Store\Format as PipeFormat;
use App\Tests\Unit\Pipes\Store\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Account\Store
 */
class FormatTest extends Format
{
    /**
     * UpdateTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct(
            $name,
            $data,
            $dataName
        );

        $this->setPassable(Store::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Account::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Store
     * @group App.Pipes.Account.Store.Format
     * @group App.Pipes.Account.Store.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Account
     * @group                    App.Pipes.Account.Store
     * @group                    App.Pipes.Account.Store.Format
     * @group                    App.Pipes.Account.Store.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
