<?php

namespace App\Tests\Unit\Pipes\Store;

use App\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Create extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var string
     */
    protected $pipe;

    /**
     * @var string
     */
    protected $passable;

    /**
     * @var string
     */
    protected $request;

    /**
     * @var array
     */
    protected $params;

    /**
     * @return string
     */
    public function getPipe()
    {
        return $this->pipe;
    }

    /**
     * @param string $pipe
     */
    public function setPipe($pipe)
    {
        $this->pipe = $pipe;
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
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Create Success
     */
    public function createSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();
        $params = $this->getParams();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass($params)
        );

        $pipe = new $pipeClass();

        return $pipe->handle(
            $passable,
            function ($passable) {
                return $passable->getModel();
            }
        );
    }

    /**
     * Create failure
     */
    public function createFailure()
    {
        $passableClass = $this->getPassable();
        $pipeClass = $this->getPipe();

        $passable = new $passableClass();

        $pipe = new $pipeClass();

        $pipe->handle(
            $passable,
            function ($passable) {
                // do nothing
            }
        );
    }
}
