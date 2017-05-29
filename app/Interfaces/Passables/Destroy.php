<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 11:09 AM
 */

namespace App\Interfaces\Passables;

/**
 * Interface Destroy
 * @package App\Interfaces\Passables
 */
interface Destroy extends Base
{
    /**
     * @param $model
     */
    public function setModel($model);

    /**
     * @return mixed
     */
    public function getModel();
}
