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
 * Class Log
 * @package App\Tasks
 */
class Log
{
    /**
     * @param $passable
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Base &$passable, Closure $next)
    {
        //TODO implement logging

        return $next($passable);
    }
}