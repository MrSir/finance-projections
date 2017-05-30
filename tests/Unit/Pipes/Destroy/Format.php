<?php

namespace App\Tests\Unit\Pipes\Destroy;

use App\Tests\TestCase;
use Exception;

/**
 * Class Format
 * @package App\Tests\Unit\Pipes\Destroy
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

        $passable = new $passableClass();
        $passable->setModel($modelClass::find(2));

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
                    2,
                    $results['results']->id
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
        $passable->setModel(
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
