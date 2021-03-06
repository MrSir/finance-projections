<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Index;

use App\Passables\Index;
use App\Pipes\Pipe;
use Throwable;

/**
 * Class Search
 * @package App\Pipes\Index
 */
abstract class Search extends Pipe
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @param Index $passable
     */
    public function buildQuery(Index &$passable)
    {
        try {
            $request = $passable->getRequest();

            $model = $this->getModel();
            $query = $model::query();

            if ($request->has('createdAtFrom')) {
                $query->where(
                    'created_at',
                    '>=',
                    $request->get('createdAtFrom') . ' 00:00:00'
                );
            }

            if ($request->has('createdAtTo')) {
                $query->where(
                    'created_at',
                    '<=',
                    $request->get('createdAtTo') . ' 23:59:59'
                );
            }

            $passable->setQuery($query);
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
