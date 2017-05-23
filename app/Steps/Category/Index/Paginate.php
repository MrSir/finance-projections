<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Steps\Category\Index;

use App\Passables\Category\Index;
use App\Exceptions\Category\Paginate as ExceptionPaginate;
use Closure;
use Exception;

/**
 * Class Paginate
 * @package App\Steps\Category\Index
 */
class Paginate
{
    /**
     * @param Index   $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws ExceptionPaginate
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
        } catch (Exception $e) {
            throw new ExceptionPaginate(
                'Category paginate failed.',
                500,
                $e
            );
        }

        return $next($passable);
    }
}
