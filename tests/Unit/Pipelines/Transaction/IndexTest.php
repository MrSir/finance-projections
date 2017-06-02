<?php

namespace App\Tests\Unit\Pipelines\Transaction\Index;

use App\Http\Requests\Transaction\Index as RequestIndex;
use App\Passables\Transaction\Index;
use App\Pipelines\Transaction\Index as PipelineIndex;
use App\Tests\Unit\Pipelines\Index as TestPipelineIndex;

/**
 * Class IndexTest
 * @package App\Tests\Unit\Pipelines\Transaction\Index
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
     * @group App.Pipelines.Transaction.Index
     * @group App.Pipelines.Transaction.Index.Fill
     * @group App.Pipelines.Transaction.Index.Fill.Success
     */
    public function testFillSuccess()
    {
        $this->fillSuccess();
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Transaction
     * @group App.Pipelines.Transaction.Index
     * @group App.Pipelines.Transaction.Index.Flush
     * @group App.Pipelines.Transaction.Index.Flush.Success
     */
    public function testFlushSuccess()
    {
        $this->flushSuccess();
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Transaction
     * @group App.Pipelines.Transaction.Index
     * @group App.Pipelines.Transaction.Index.Flush
     * @group App.Pipelines.Transaction.Index.Flush.Failure
     */
    public function testFlushFailure()
    {
        $this->flushFailure();
    }
}
