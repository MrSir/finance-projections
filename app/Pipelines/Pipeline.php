<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines;

use App\Pipes\Exception\Format as ExceptionFormat;
use App\Pipes\Exception\Log as ExceptionLog;
use Closure;
use Exception;
use Illuminate\Pipeline\Pipeline as IlluminatePipeline;

abstract class Pipeline extends IlluminatePipeline
{
    /**
     * @var Closure
     */
    protected $burstClosure;

    /**
     * Index constructor.
     */
    public function __construct()
    {
        parent::__construct(app());

        $this->setBurstClosure(
            function (Exception $e) {
                return $this->burst($e);
            }
        );
    }

    /**
     * Overwriting the burst closure
     *
     * @param Closure $destination
     *
     * @return $this
     */
    public function onBurst(Closure $destination)
    {
        $this->setBurstClosure($destination);

        return $this;
    }

    /**
     * Wrap the then pipeline function with a burst handler
     *
     * @param Closure $destination
     *
     * @return array|mixed
     */
    public function then(Closure $destination)
    {
        try {
            return parent::then($destination);
        } catch (Exception $e) {
            return $this->getBurstClosure()($e);
        }
    }

    /**
     * This is the burst function, it handles the exceptions from the pipeline
     * This is the default function it can be overwritten by using onBurst();
     * Example:
     * $pipeline->send($passable)
     *      ->through(
     *          [
     *              Pipe1::class,
     *              Pipe2::class,
     *          ]
     *       )
     *      ->onBurst(
     *          function (Exception $e) {
     *              return [
     *                  'code' => 500,
     *                  'message' => 'overwritten burst'
     *              ];
     *          }
     *      )
     *      ->then(
     *          function ($passable) {
     *              return $passable;
     *          }
     *      );
     *
     * @param Exception $e
     *
     * @return array
     */
    public function burst(Exception $e)
    {
        return $this->send($e)
            ->through(
                [
                    ExceptionLog::class,
                    ExceptionFormat::class,
                ]
            )
            ->then(
                function ($response) {
                    return $response;
                }
            );
    }

    /**
     * @return mixed
     */
    public function getPassable()
    {
        return $this->passable;
    }

    /**
     * @param mixed $passable
     */
    public function setPassable($passable)
    {
        $this->passable = $passable;
    }

    /**
     * @return Closure
     */
    public function getBurstClosure()
    {
        return $this->burstClosure;
    }

    /**
     * @param Closure $burstClosure
     */
    public function setBurstClosure($burstClosure)
    {
        $this->burstClosure = $burstClosure;
    }
}
