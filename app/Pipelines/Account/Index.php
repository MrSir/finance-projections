<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines\Account;

use App\Passables\Account\Index as PassableIndex;
use App\Pipelines\Pipeline;
use App\Pipes\Account\Index\Format;
use App\Pipes\Account\Index\Paginate;
use App\Pipes\Account\Index\Search;
use App\Pipes\Account\Index\Sort;

/**
 * Class Index
 * @package App\Pipelines\Account
 */
class Index extends Pipeline
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
                    Sort::class,
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
