<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Index;

use App\Interfaces\Passables\Index;
use App\Pipes\Pipe;
use Closure;
use Exception;
use Throwable;

/**
 * Class Sort
 * @package App\Pipes\Index
 */
abstract class Sort extends Pipe
{
    /**
     * @param Index   $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws Exception
     */
    public function handle(Index &$passable, Closure $next)
    {
        try {
            $request = $passable->getRequest();
            $query = $passable->getQuery();

            $orderColumn = 'id';
            $orderDirection = 'asc';

            if ($request->has('orderColumn')) {
                $orderColumn = $request->get('orderColumn');
            }

            if ($request->has('orderDirection')) {
                $orderDirection = $request->get('orderDirection');
            }

            // add in the sorter
            $query->orderBy($orderColumn, $orderDirection);

            $passable->setQuery($query);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
