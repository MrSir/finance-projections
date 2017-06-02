<?php

namespace App\Tests\Unit\Pipes\Account\Index;

use App\Models\Account;
use App\Passables\Account\Index;
use App\Pipes\Account\Index\Format as PipeFormat;
use App\Tests\Unit\Pipes\Index\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Account\Index
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

        $this->setPassable(Index::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Account::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Format
     * @group App.Pipes.Account.Index.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Account
     * @group                    App.Pipes.Account.Index
     * @group                    App.Pipes.Account.Index.Format
     * @group                    App.Pipes.Account.Index.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
