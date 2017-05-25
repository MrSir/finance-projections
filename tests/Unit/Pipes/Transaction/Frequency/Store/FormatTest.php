<?php

namespace App\Tests\Unit\Pipes\Transaction\Frequency\Store;

use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Store;
use App\Pipes\Transaction\Frequency\Store\Format as PipeFormat;
use App\Tests\Unit\Pipes\Store\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Transaction\Frequency\Store
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

        $this->setPassable(Store::class);
        $this->setPipe(PipeFormat::class);
        $this->setModel(Frequency::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Store
     * @group App.Pipes.Transaction.Frequency.Store.Format
     * @group App.Pipes.Transaction.Frequency.Store.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Frequency
     * @group                    App.Pipes.Transaction.Frequency.Store
     * @group                    App.Pipes.Transaction.Frequency.Store.Format
     * @group                    App.Pipes.Transaction.Frequency.Store.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Frequency format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
