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
use Exception;

/**
 * Class Format
 * @package App\Tasks\Category
 */
class Format
{
    /**
     * @param Index   $passable
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Index &$passable, Closure $next)
    {
        if ($passable->getStatus() == 0) {
            try {
                $response = [
                    'results' => $passable->getResults(),
                    'per_page' => $passable->getPerPage(),
                    'page' => $passable->getPage(),
                    'totals' => $passable->getTotals(),
                ];

                $passable->setResponse($response);
            } catch (Exception $e) {
                $passable->setStatus(3);
                $passable->setException($e);
            }
        }

        return $next($passable);
    }
}
