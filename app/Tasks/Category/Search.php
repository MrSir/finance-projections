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

class Search
{
    public function handle(Index &$passable, Closure $next)
    {
        $request = $passable->getRequest();

        $categories = Category::query();

        if ($request->has('name')) {
            $categories->where(
                'name',
                'LIKE',
                '%' . $request->get('name') . '%'
            );
        }

        if ($request->has('description')) {
            $categories->where(
                'description',
                'LIKE',
                '%' . $request->get('description') . '%'
            );
        }

        if ($request->has('created_at_from')) {
            $categories->where(
                'created_at',
                '>=',
                $request->get('created_at_from') . ' 00:00:00'
            );
        }

        if ($request->has('created_at_to')) {
            $categories->where(
                'created_at',
                '<=',
                $request->get('created_at_to') . ' 23:59:59'
            );
        }

        $passable->setQuery($categories);

        return $next($passable);
    }
}