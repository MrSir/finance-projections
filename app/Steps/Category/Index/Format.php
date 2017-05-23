<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Steps\Category\Index;

use App\Exceptions\Category\Format as ExceptionFormat;
use App\Passables\Category\Index;
use Closure;
use Exception;

/**
 * Class Format
 * @package App\Steps\Category\Index
 */
class Format
{
    /**
     * @param Index   $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws ExceptionFormat
     */
    public function handle(Index &$passable, Closure $next)
    {
        try {
            $response = [
                'code' => 200,
                'results' => $passable->getResults(),
                'per_page' => (int)$passable->getPerPage(),
                'page' => (int)$passable->getPage(),
                'totals' => (int)$passable->getTotals(),
            ];

            $passable->setResponse($response);
        } catch (Exception $e) {
            throw new ExceptionFormat(
                'Category format failed.',
                500,
                $e
            );
        }

        return $next($passable);
    }
}
