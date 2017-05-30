<?php

namespace App\Tests\Unit\Pipes\Destroy;

use App\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class Delete
 * @package App\Tests\Unit\Pipes\Destroy
 */
class Delete extends TestCase
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
     * @var Model;
     */
    protected $model;

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
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Delete Success
     */
    public function deleteSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();
        $model = $this->getModel();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass()
        );
        $passable->setModel($model);

        $pipe = new $pipeClass();

        return $pipe->handle(
            $passable,
            function ($passable) {
                return $passable->getModel();
            }
        );
    }

    /**
     * Delete failure
     */
    public function deleteFailure()
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
