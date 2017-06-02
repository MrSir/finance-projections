<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines\Transaction;

use App\Passables\Transaction\Destroy as PassableDestroy;
use App\Pipelines\Pipeline;
use App\Pipes\Transaction\Destroy\Delete;
use App\Pipes\Transaction\Destroy\Format;

/**
 * Class Destroy
 * @package App\Pipelines\Transaction
 */
class Destroy extends Pipeline
{
    /**
     * This is the fill function, it initializes the pipeline
     *
     * @param $request
     * @param $transaction
     *
     * @return $this
     */
    public function fill($request, $transaction)
    {
        $passable = new PassableDestroy();
        $passable->setRequest($request);
        $passable->setModel($transaction);

        $this->setPassable($passable);

        return $this;
    }

    /**
     * This is the flush function, it executes the entire pipe
     * @return array
     */
    public function flush()
    {
        return $this->send($this->getPassable())
            ->through(
                [
                    Delete::class,
                    Format::class,
                ]
            )
            ->then(
                function (PassableDestroy $passable) {
                    return $passable->getResponse();
                }
            );
    }
}
