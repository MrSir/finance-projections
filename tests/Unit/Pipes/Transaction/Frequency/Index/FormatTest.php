<?php

namespace App\Tests\Unit\Pipes\Transaction\Frequency\Index;

use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Index;
use App\Pipes\Transaction\Frequency\Index\Format as PipeFormat;
use App\Tests\Unit\Pipes\Index\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Transaction\Frequency\Index
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
        $this->setModel(Frequency::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Index
     * @group App.Pipes.Transaction.Frequency.Index.Format
     * @group App.Pipes.Transaction.Frequency.Index.Format.Success
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
     * @group                    App.Pipes.Transaction.Frequency.Index
     * @group                    App.Pipes.Transaction.Frequency.Index.Format
     * @group                    App.Pipes.Transaction.Frequency.Index.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Frequency format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
