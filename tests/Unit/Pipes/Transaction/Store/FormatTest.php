<?php

namespace App\Tests\Unit\Pipes\Transaction\Store;

use App\Models\Transaction;
use App\Passables\Transaction\Store;
use App\Pipes\Transaction\Store\Format as PipeFormat;
use App\Tests\Unit\Pipes\Store\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Transaction\Store
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
        $this->setModel(Transaction::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Store
     * @group App.Pipes.Transaction.Store.Format
     * @group App.Pipes.Transaction.Store.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Store
     * @group                    App.Pipes.Transaction.Store.Format
     * @group                    App.Pipes.Transaction.Store.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
