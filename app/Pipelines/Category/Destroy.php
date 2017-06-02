<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines\Category;

use App\Passables\Category\Destroy as PassableDestroy;
use App\Pipelines\Pipeline;
use App\Pipes\Category\Destroy\Delete;
use App\Pipes\Category\Destroy\Format;

/**
 * Class Destroy
 * @package App\Pipelines\Category
 */
class Destroy extends Pipeline
{
    /**
     * This is the fill function, it initializes the pipeline
     *
     * @param $request
     * @param $category
     *
     * @return $this
     */
    public function fill($request, $category)
    {
        $passable = new PassableDestroy();
        $passable->setRequest($request);
        $passable->setModel($category);

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
