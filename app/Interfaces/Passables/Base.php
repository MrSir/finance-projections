<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 11:09 AM
 */

namespace App\Interfaces\Passables;

interface Base
{
    public function getRequest();
    public function setRequest($request);

    public function getResponse();
    public function setResponse($response);
}