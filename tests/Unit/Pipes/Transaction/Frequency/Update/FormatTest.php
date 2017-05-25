<?php

namespace App\Tests\Unit\Pipes\Transaction\Frequency\Update;

use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Update;
use App\Pipes\Transaction\Frequency\Update\Format as PipeFormat;
use App\Tests\Unit\Pipes\Update\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Transaction\Frequency\Update
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
        $this->setModel(Frequency::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Update
     * @group App.Pipes.Transaction.Frequency.Update.Format
     * @group App.Pipes.Transaction.Frequency.Update.Format.Success
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
     * @group                    App.Pipes.Transaction.Frequency.Update
     * @group                    App.Pipes.Transaction.Frequency.Update.Format
     * @group                    App.Pipes.Transaction.Frequency.Update.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Frequency format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
