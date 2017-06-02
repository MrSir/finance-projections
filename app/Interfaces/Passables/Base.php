<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 11:09 AM
 */

namespace App\Interfaces\Passables;

/**
 * Interface Base
 * @package App\Interfaces\Passables
 */
interface Base
{
    /**
     * @return mixed
     */
    public function getRequest();

    /**
     * @param $request
     *
     * @return mixed
     */
    public function setRequest($request);

    /**
     * @return mixed
     */
    public function getResponse();

    /**
     * @param $response
     *
     * @return mixed
     */
    public function setResponse($response);
}
