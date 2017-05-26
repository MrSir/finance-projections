<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 11:09 AM
 */

namespace App\Interfaces\Passables;

/**
 * Interface Update
 * @package App\Interfaces\Passables
 */
interface Update extends Base
{
    /**
     * @param $model
     *
     * @return mixed
     */
    public function setModel($model);

    /**
     * @return mixed
     */
    public function getModel();
}
