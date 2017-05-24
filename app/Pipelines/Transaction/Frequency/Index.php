<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines\Transaction\Frequency;

use App\Passables\Transaction\Frequency\Index as PassableIndex;
use App\Pipelines\Index as BaseIndex;
use App\Pipes\Transaction\Frequency\Index\Format;
use App\Pipes\Transaction\Frequency\Index\Paginate;
use App\Pipes\Transaction\Frequency\Index\Search;

/**
 * Class Index
 * @package App\Pipelines\Transaction\Frequency
 */
class Index extends BaseIndex
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
        $passable = new PassableIndex();
        $passable->setRequest($request);

        $this->setPassable($passable);

        return $this;
    }

    /**
     * This is the flush function, it executes the entire pipe
     *
     * @return PassableIndex
     */
    public function flush()
    {
        return $this->send($this->getPassable())
            ->through(
                [
                    Search::class,
                    Paginate::class,
                    Format::class
                ]
            )
            ->then(
                function (PassableIndex $passable) {
                    return $passable->getResponse();
                }
            );
    }
}
