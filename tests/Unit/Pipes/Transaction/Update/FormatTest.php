<?php

namespace App\Tests\Unit\Pipes\Transaction\Update;

use App\Models\Transaction;
use App\Passables\Transaction\Update;
use App\Pipes\Transaction\Update\Format as PipeFormat;
use App\Tests\Unit\Pipes\Update\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Transaction\Update
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

        $this->setPassable(Update::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Transaction::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Update
     * @group App.Pipes.Transaction.Update.Format
     * @group App.Pipes.Transaction.Update.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Update
     * @group                    App.Pipes.Transaction.Update.Format
     * @group                    App.Pipes.Transaction.Update.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
