<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines\Transaction;

use App\Passables\Transaction\Store as PassableStore;
use App\Pipelines\Pipeline;
use App\Pipes\Transaction\Store\Create;
use App\Pipes\Transaction\Store\Format;

/**
 * Class Index
 * @package App\Pipelines\Transaction\
 */
class Store extends Pipeline
{
    /**
     * This is the fill function, it initializes the pipeline
     *
     * @param $request
     *
     * @return $this
     */
    public function fill($request)
    {
        $passable = new PassableStore();
        $passable->setRequest($request);

        $this->setPassable($passable);

        return $this;
    }

    /**
     * This is the flush function, it executes the entire pipe
     * @return PassableStore
     */
    public function flush()
    {
        return $this->send($this->getPassable())
            ->through(
                [
                    Create::class,
                    Format::class,
                ]
            )
            ->then(
                function (PassableStore $passable) {
                    return $passable->getResponse();
                }
            );
    }
}
