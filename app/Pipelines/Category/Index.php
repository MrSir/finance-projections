<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines\Category;

use App\Passables\Category\Index as PassableIndex;
use App\Pipelines\Index as BaseIndex;
use App\Tasks\Category\Format;
use App\Tasks\Category\Paginate;
use App\Tasks\Category\Search;

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
                function ($response) {
                    return $response;
                }
            );
    }
}