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
use App\Tasks\Category\Format as CategoryFormat;
use App\Tasks\Category\Paginate;
use App\Tasks\Category\Search;
use App\Tasks\Exception\Format as ExceptionFormat;
use App\Tasks\Exception\Log as ExceptionLog;

/**
 * Class Index
 * @package App\Pipelines\Category
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
                    CategoryFormat::class
                ]
            )
            ->then(
                function (PassableIndex $passable) {
                    return $passable;
                }
            );
    }

    /**
     * This is the burst function, it handles the exceptions from the pipeline
     *
     * @param PassableIndex $passable
     *
     * @return array
     */
    public function burst(PassableIndex $passable)
    {
        return $this->send($passable)
            ->through(
                [
                    ExceptionLog::class,
                    ExceptionFormat::class
                ]
            )
            ->then(
                function (PassableIndex $passable) {
                    return $passable->getResponse();
                }
            );
    }
}
