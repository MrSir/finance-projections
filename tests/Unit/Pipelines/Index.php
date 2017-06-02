<?php

namespace App\Tests\Unit\Pipelines;

use App\Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;

class Index extends TestCase
{
    /**
     * @var string
     */
    protected $pipeline;

    /**
     * @var string
     */
    protected $passable;

    /**
     * @var string
     */
    protected $request;

    /**
     * @return string
     */
    public function getPipeline()
    {
        return $this->pipeline;
    }

    /**
     * @param string $pipeline
     */
    public function setPipeline($pipeline)
    {
        $this->pipeline = $pipeline;
    }

    /**
     * @return string
     */
    public function getPassable()
    {
        return $this->passable;
    }

    /**
     * @param string $passable
     */
    public function setPassable($passable)
    {
        $this->passable = $passable;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * Fill Success
     */
    public function fillSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipelineClass = $this->getPipeline();

        $pipeline = new $pipelineClass();
        $result = $pipeline->fill(new $requestClass());

        $passable = $result->getPassable();

        $this->assertEquals($passableClass, get_class($passable));
        $this->assertEquals($requestClass, get_class($passable->getRequest()));
    }

    /**
     * Flush Success
     */
    public function flushSuccess()
    {
        $requestClass = $this->getRequest();
        $pipelineClass = $this->getPipeline();

        $pipeline = new $pipelineClass();
        $pipeline->fill(new $requestClass());
        $results = $pipeline->flush();

        $this->assertEquals(
            200,
            $results['code']
        );
        $this->assertEquals(
            25,
            $results['per_page']
        );
        $this->assertEquals(
            1,
            $results['page']
        );
        $this->assertEquals(
            1,
            $results['results'][0]->id
        );
    }

    /**
     * Flush Failure
     */
    public function flushFailure()
    {
        $pipelineClass = $this->getPipeline();

        $pipeline = new $pipelineClass();
        $pipeline->fill(null);
        $results = $pipeline->flush();

        $this->assertEquals(
            500,
            $results['code']
        );
    }
}
