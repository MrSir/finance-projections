<?php

namespace App\Tests\Unit\Pipes\Index;

use App\Tests\TestCase;

class Paginate extends TestCase
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
     * Paginate success
     */
    public function paginateSuccess()
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
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(
                    25,
                    $limit
                );
                $this->assertEquals(
                    0,
                    $offset
                );
            }
        );
    }

    /**
     * Paginate per page success
     */
    public function paginatePerPageSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();
        $modelClass = $this->getModel();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass(
                [
                    'perPage' => 10,
                ]
            )
        );
        $passable->setQuery($modelClass::query());

        $paginateStep = new $pipeClass();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(
                    10,
                    $limit
                );
                $this->assertEquals(
                    0,
                    $offset
                );
            }
        );
    }

    /**
     * Paginate page success
     */
    public function paginatePageSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();
        $modelClass = $this->getModel();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass(
                [
                    'page' => 2,
                ]
            )
        );
        $passable->setQuery($modelClass::query());

        $paginateStep = new $pipeClass();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(
                    25,
                    $limit
                );
                $this->assertEquals(
                    25,
                    $offset
                );
            }
        );
    }

    /**
     * Paginate failure
     */
    public function paginateFailure()
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
