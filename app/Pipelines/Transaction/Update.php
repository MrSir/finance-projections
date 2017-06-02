<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines\Transaction;

use App\Passables\Transaction\Update as PassableUpdate;
use App\Pipelines\Pipeline;
use App\Pipes\Transaction\Update\Update as PipeUpdate;
use App\Pipes\Transaction\Update\Format;

/**
 * Class Update
 * @package App\Pipelines\Transaction
 */
class Update extends Pipeline
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
        $passable = new PassableUpdate();
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
                    PipeUpdate::class,
                    Format::class,
                ]
            )
            ->then(
                function (PassableUpdate $passable) {
                    return $passable->getResponse();
                }
            );
    }
}
