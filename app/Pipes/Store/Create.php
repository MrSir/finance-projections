<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Store;

use App\Passables\Store;
use App\Pipes\Pipe;
use Throwable;

/**
 * Class Create
 * @package App\Pipes\Store
 */
abstract class Create extends Pipe
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @param Store $passable
     */
    public function storeModel(Store &$passable)
    {
        try {
            $request = $passable->getRequest();

            $model = $this->getModel();
            $newModel = new $model();
            $newModel->fill($request->all());
            $newModel->save();

            $passable->setModel($newModel);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType(
                $this->getExceptionMessage(),
                500,
                $e
            );
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
