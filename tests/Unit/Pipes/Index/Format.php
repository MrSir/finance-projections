<?php

namespace App\Tests\Unit\Pipes\Index;

use App\Tests\TestCase;
use Exception;

/**
 * Class Format
 * @package App\Tests\Unit\Pipes\Index
 */
class Format extends TestCase
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
     * Format Success
     */
    public function formatSuccess()
    {
        $passableClass = $this->getPassable();
        $pipeClass = $this->getPipe();
        $modelClass = $this->getModel();

        $results = collect(
            [
                $modelClass::find(1),
            ]
        );

        $passable = new $passableClass();
        $passable->setResults($results);
        $passable->setPerPage(10);
        $passable->setPage(3);
        $passable->setTotals(1);

        $pipe = new $pipeClass();

        $pipe->handle(
            $passable,
            function ($passable) {
                $results = $passable->getResponse();

                $this->assertEquals(
                    200,
                    $results['code']
                );
                $this->assertEquals(
                    1,
                    $results['totals']
                );
                $this->assertEquals(
                    10,
                    $results['per_page']
                );
                $this->assertEquals(
                    3,
                    $results['page']
                );
                $this->assertEquals(
                    1,
                    $results['results'][0]->id
                );
            }
        );
    }

    /**
     * Format Failure
     */
    public function formatFailure()
    {
        $passableClass = $this->getPassable();
        $pipeClass = $this->getPipe();

        $passable = new $passableClass();

        // force the page getter to throw an exception
        $passable->setPage(
            function () {
                throw new Exception('test');
            }
        );

        $pipe = new $pipeClass();
        $pipe->handle(
            $passable,
            function ($passable) {
                //do nothing
            }
        );
    }
}
