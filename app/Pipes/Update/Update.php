<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Update;

use App\Passables\Update as PassableUpdate;
use App\Pipes\Pipe;
use Throwable;

/**
 * Class Create
 * @package App\Pipes\Update
 */
abstract class Update extends Pipe
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @param PassableUpdate $passable
     */
    public function updateModel(PassableUpdate &$passable)
    {
        try {
            $request = $passable->getRequest();
            $model = $passable->getModel();

            $model->fill($request->all());
            $model->save();

            $passable->setModel($model);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
}
