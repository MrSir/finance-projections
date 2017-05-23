<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:24 AM
 */

namespace App\Interfaces;

interface Pipeline
{
    public function fill($request);

    public function flush();
}
