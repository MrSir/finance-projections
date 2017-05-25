<?php

namespace App\Tests\Unit\Pipes\Account\Update;

use App\Models\Account;
use App\Passables\Account\Update;
use App\Pipes\Account\Update\Format as PipeFormat;
use App\Tests\Unit\Pipes\Update\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Account\Update
 */
class FormatTest extends Format
{
    /**
     * SearchTest constructor.
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

        $this->setPassable(Update::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Account::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Update
     * @group App.Pipes.Account.Update.Format
     * @group App.Pipes.Account.Update.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Account
     * @group                    App.Pipes.Account.Update
     * @group                    App.Pipes.Account.Update.Format
     * @group                    App.Pipes.Account.Update.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
