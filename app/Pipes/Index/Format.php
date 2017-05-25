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
 * Class Format
 * @package App\Pipes\Index
 */
abstract class Format extends Pipe
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
            $response = [
                'code' => 200,
                'results' => $passable->getResults(),
                'per_page' => (int)$passable->getPerPage(),
                'page' => (int)$passable->getPage(),
                'totals' => (int)$passable->getTotals(),
            ];

            $passable->setResponse($response);
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
