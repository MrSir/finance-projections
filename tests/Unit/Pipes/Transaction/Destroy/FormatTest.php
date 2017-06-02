<?php

namespace App\Tests\Unit\Pipes\Transaction\Destroy;

use App\Models\Transaction;
use App\Passables\Transaction\Destroy;
use App\Pipes\Transaction\Destroy\Format as PipeFormat;
use App\Tests\Unit\Pipes\Destroy\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Transaction\Destroy
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
        $this->setModel(Transaction::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Destroy
     * @group App.Pipes.Transaction.Destroy.Format
     * @group App.Pipes.Transaction.Destroy.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Destroy
     * @group                    App.Pipes.Transaction.Destroy.Format
     * @group                    App.Pipes.Transaction.Destroy.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
