<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 8:18 AM
 */

namespace App\Pipelines;

use Illuminate\Pipeline\Pipeline;

class Index extends Pipeline
{
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
}
