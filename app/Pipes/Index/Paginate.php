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
 * Class Paginate
 * @package App\Pipes\Index
 */
abstract class Paginate extends Pipe
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

            $total = $query->count();
            $perPage = 25;
            $page = 1;

            if ($request->has('per_page')) {
                $perPage = $request->get('per_page');
            }

            if ($request->has('page')) {
                $page = $request->get('page');
            }

            // add in the paginated filter
            $query->take($perPage)
                ->skip(($page - 1) * $perPage);

            $passable->setPerPage($perPage);
            $passable->setPage($page);
            $passable->setResults($query->get());
            $passable->setTotals($total);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType(
                $this->getExceptionMessage(),
                500,
                $e
            );
        }

        return $next($passable);
    }
}
