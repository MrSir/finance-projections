<?php

namespace App\Tests\Unit\Pipes\Transaction\Index;

use App\Models\Transaction;
use App\Passables\Transaction\Index;
use App\Pipes\Transaction\Index\Format as PipeFormat;
use App\Tests\Unit\Pipes\Index\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Transaction\Index
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
        $this->setModel(Transaction::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Format
     * @group App.Pipes.Transaction.Index.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Index
     * @group                    App.Pipes.Transaction.Index.Format
     * @group                    App.Pipes.Transaction.Index.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
