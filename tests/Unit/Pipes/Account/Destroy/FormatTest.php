<?php

namespace App\Tests\Unit\Pipes\Account\Destroy;

use App\Models\Account;
use App\Passables\Account\Destroy;
use App\Pipes\Account\Destroy\Format as PipeFormat;
use App\Tests\Unit\Pipes\Destroy\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Account\Destroy
 */
class FormatTest extends Format
{
    /**
     * FormatTest constructor.
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

        $this->setPassable(Destroy::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Account::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Destroy
     * @group App.Pipes.Account.Destroy.Format
     * @group App.Pipes.Account.Destroy.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Account
     * @group                    App.Pipes.Account.Destroy
     * @group                    App.Pipes.Account.Destroy.Format
     * @group                    App.Pipes.Account.Destroy.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
