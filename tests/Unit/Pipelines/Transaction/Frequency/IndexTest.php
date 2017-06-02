<?php

namespace App\Tests\Unit\Pipelines\Transaction\Frequency\Index;

use App\Http\Requests\Transaction\Frequency\Index as RequestIndex;
use App\Passables\Transaction\Frequency\Index;
use App\Pipelines\Transaction\Frequency\Index as PipelineIndex;
use App\Tests\Unit\Pipelines\Index as TestPipelineIndex;

/**
 * Class IndexTest
 * @package App\Tests\Unit\Pipelines\Transaction\Frequency\Index
 */
class IndexTest extends TestPipelineIndex
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

        $this->setPassable(Index::class);
        $this->setRequest(RequestIndex::class);
        $this->setPipeline(PipelineIndex::class);
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Transaction
     * @group App.Pipelines.Transaction.Frequency
     * @group App.Pipelines.Transaction.Frequency.Index
     * @group App.Pipelines.Transaction.Frequency.Index.Fill
     * @group App.Pipelines.Transaction.Frequency.Index.Fill.Success
     */
    public function testFillSuccess()
    {
        $this->fillSuccess();
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Transaction
     * @group App.Pipelines.Transaction.Frequency
     * @group App.Pipelines.Transaction.Frequency.Index
     * @group App.Pipelines.Transaction.Frequency.Index.Flush
     * @group App.Pipelines.Transaction.Frequency.Index.Flush.Success
     */
    public function testFlushSuccess()
    {
        $this->flushSuccess();
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Transaction
     * @group App.Pipelines.Transaction.Frequency
     * @group App.Pipelines.Transaction.Frequency.Index
     * @group App.Pipelines.Transaction.Frequency.Index.Flush
     * @group App.Pipelines.Transaction.Frequency.Index.Flush.Failure
     */
    public function testFlushFailure()
    {
        $this->flushFailure();
    }
}
