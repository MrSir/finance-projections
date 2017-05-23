<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Tasks\Category;

use App\Models\Category;
use App\Passables\Category\Index;
use Closure;

class Format
{
    public function handle(Index &$passable, Closure $next)
    {
        $response = [
            'results' => $passable->getResults(),
            'per_page' => $passable->getPerPage(),
            'page' => $passable->getPage(),
            'totals' => $passable->getTotals(),
        ];

        return $next($response);
    }
}