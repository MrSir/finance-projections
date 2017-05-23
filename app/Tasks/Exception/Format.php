<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Tasks\Exception;

use App\Interfaces\Passables\Base;
use Closure;

/**
 * Class Format
 * @package App\Tasks
 */
class Format
{
    /**
     * @param Base    $passable
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Base &$passable, Closure $next)
    {
        $passable->setResponse(
            [
                'code' => $passable->getStatus(),
                'message' => $passable->getException()
                    ->getMessage(),
            ]
        );

        return $next($passable);
    }
}
