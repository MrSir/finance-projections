<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Destroy;

use App\Passables\Destroy as PassableDestroy;
use App\Pipes\Pipe;
use Throwable;

/**
 * Class Delete
 * @package App\Pipes\Destroy
 */
abstract class Delete extends Pipe
{
    /**
     * @param PassableDestroy $passable
     */
    public function deleteModel(PassableDestroy &$passable)
    {
        try {
            $model = $passable->getModel();

            $model->delete();

            $passable->setModel($model);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }
    }
}
