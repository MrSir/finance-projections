<?php

namespace App\Tests\Unit\Pipes\Index;

use App\Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;

class Search extends TestCase
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
     * Search Success
     */
    public function searchSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass()
        );

        $pipe = new $pipeClass();

        $pipe->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();

                $this->assertEquals(Builder::class, get_class($results));
            }
        );
    }

    /**
     * Search by Name success
     */
    public function searchByNameSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass(
                [
                    'name' => 'ransfer',
                ]
            )
        );

        $pipe = new $pipeClass();

        $pipe->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $whereClauses = $results->getQuery()->wheres;

                $this->assertEquals(Builder::class, get_class($results));
                $this->assertEquals('name', $whereClauses[0]['column']);
                $this->assertEquals('LIKE', $whereClauses[0]['operator']);
                $this->assertEquals('%ransfer%', $whereClauses[0]['value']);
            }
        );
    }

    /**
     * Search by description success
     */
    public function searchByDescriptionSuccess()
    {
        $passableClass = $this->getPassable();
        $requestClass = $this->getRequest();
        $pipeClass = $this->getPipe();

        $passable = new $passableClass();
        $passable->setRequest(
            new $requestClass(
                [
                    'description' => 'ransfer',
                ]
            )
        );

        $pipe = new $pipeClass();

        $pipe->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $whereClauses = $results->getQuery()->wheres;

                $this->assertEquals(Builder::class, get_class($results));
                $this->assertEquals('description', $whereClauses[0]['column']);
                $this->assertEquals('LIKE', $whereClauses[0]['operator']);
                $this->assertEquals('%ransfer%', $whereClauses[0]['value']);
            }
        );
    }

    /**
     * Search failure
     */
    public function searchFailure()
    {
        $passableClass = $this->getPassable();
        $pipeClass = $this->getPipe();

        $passable = new $passableClass();

        $pipe = new $pipeClass();

        $pipe->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();

                $this->assertEquals(Builder::class, get_class($results));
            }
        );
    }
}
