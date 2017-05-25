<?php

namespace App\Tests\Unit\Pipes\Index;

use App\Tests\TestCase;

/**
 * Class Sort
 * @package App\Tests\Unit\Pipes\Index
 */
class Sort extends TestCase
{
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
     * @var string
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
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Sort success
     */
    public function sortSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();
        $modelClass = $this->getModel();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass()
        );
        $passable->setQuery($modelClass::query());

        $paginateStep = new $pipeClass();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $orders = $results->getQuery()->orders;

                $this->assertEquals(
                    'id',
                    $orders[0]['column']
                );
                $this->assertEquals(
                    'asc',
                    $orders[0]['direction']
                );
            }
        );
    }

    /**
     * Sort column success
     */
    public function sortColumnSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();
        $modelClass = $this->getModel();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass(
                [
                    'order_column' => 'name',
                ]
            )
        );
        $passable->setQuery($modelClass::query());

        $paginateStep = new $pipeClass();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $orders = $results->getQuery()->orders;

                $this->assertEquals(
                    'name',
                    $orders[0]['column']
                );
                $this->assertEquals(
                    'asc',
                    $orders[0]['direction']
                );
            }
        );
    }

    /**
     * Sort direction success
     */
    public function sortDirectionSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();
        $modelClass = $this->getModel();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass(
                [
                    'order_direction' => 'desc',
                ]
            )
        );
        $passable->setQuery($modelClass::query());

        $paginateStep = new $pipeClass();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $orders = $results->getQuery()->orders;

                $this->assertEquals(
                    'id',
                    $orders[0]['column']
                );
                $this->assertEquals(
                    'desc',
                    $orders[0]['direction']
                );
            }
        );
    }

    /**
     * Sort failure
     */
    public function sortFailure()
    {
        $passableClass = $this->getPassable();
        $pipeClass = $this->getPipe();

        $passable = new $passableClass();

        $paginateStep = new $pipeClass();

        $paginateStep->handle(
            $passable,
            function ($passable) {
            }
        );
    }
}
