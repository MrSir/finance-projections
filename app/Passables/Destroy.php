<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:42 AM
 */

namespace App\Passables;

use App\Interfaces\Passables\Destroy as PassableDestroy;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Destroy
 * @package App\Passables
 */
class Destroy extends Base implements PassableDestroy
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
}
