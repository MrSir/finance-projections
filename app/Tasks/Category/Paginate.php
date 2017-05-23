<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Tasks\Category;

use Log;
use App\Passables\Category\Index;
use Closure;

class Paginate
{
    public function handle(Index &$passable, Closure $next)
    {
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

        $query->take($perPage)
            ->skip($page-1);

        $passable->setPerPage($perPage);
        $passable->setPage($page);
        $passable->setResults($query->get());
        $passable->setTotals($total);

        return $next($passable);
    }
}