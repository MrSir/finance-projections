<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:24 AM
 */

namespace App\Interfaces;

/**
 * Interface Pipeline
 * @package App\Interfaces
 */
interface Pipeline
{
    /**
     * @param $request
     *
     * @return mixed
     */
    public function fill($request);

    /**
     * @return mixed
     */
    public function flush();
}
