<?php

namespace App\Tests\Unit\Pipelines\Category\Index;

use App\Http\Requests\Category\Index as RequestIndex;
use App\Passables\Category\Index;
use App\Pipelines\Category\Index as PipelineIndex;
use App\Tests\Unit\Pipelines\Index as TestPipelineIndex;

/**
 * Class IndexTest
 * @package App\Tests\Unit\Pipelines\Category\Index
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
     * @group App.Pipelines.Category
     * @group App.Pipelines.Category.Index
     * @group App.Pipelines.Category.Index.Fill
     * @group App.Pipelines.Category.Index.Fill.Success
     */
    public function testFillSuccess()
    {
        $this->fillSuccess();
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Category
     * @group App.Pipelines.Category.Index
     * @group App.Pipelines.Category.Index.Flush
     * @group App.Pipelines.Category.Index.Flush.Success
     */
    public function testFlushSuccess()
    {
        $this->flushSuccess();
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Category
     * @group App.Pipelines.Category.Index
     * @group App.Pipelines.Category.Index.Flush
     * @group App.Pipelines.Category.Index.Flush.Failure
     */
    public function testFlushFailure()
    {
        $this->flushFailure();
    }
}
