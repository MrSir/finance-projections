<?php

namespace App\Tests\Unit\Pipelines\Account\Index;

use App\Http\Requests\Account\Index as RequestIndex;
use App\Passables\Account\Index;
use App\Pipelines\Account\Index as PipelineIndex;
use App\Tests\Unit\Pipelines\Index as TestPipelineIndex;

/**
 * Class IndexTest
 * @package App\Tests\Unit\Pipelines\Account\Index
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
     * @group App.Pipelines.Account
     * @group App.Pipelines.Account.Index
     * @group App.Pipelines.Account.Index.Fill
     * @group App.Pipelines.Account.Index.Fill.Success
     */
    public function testFillSuccess()
    {
        $this->fillSuccess();
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Account
     * @group App.Pipelines.Account.Index
     * @group App.Pipelines.Account.Index.Flush
     * @group App.Pipelines.Account.Index.Flush.Success
     */
    public function testFlushSuccess()
    {
        $this->flushSuccess();
    }

    /**
     * @group App
     * @group App.Pipelines
     * @group App.Pipelines.Account
     * @group App.Pipelines.Account.Index
     * @group App.Pipelines.Account.Index.Flush
     * @group App.Pipelines.Account.Index.Flush.Failure
     */
    public function testFlushFailure()
    {
        $this->flushFailure();
    }
}
