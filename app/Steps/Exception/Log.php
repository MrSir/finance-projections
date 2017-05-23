<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Steps\Exception;

use Closure;
use Exception;

/**
 * Class Log
 * @package App\Steps
 */
class Log
{
    /**
     * @param Exception $e
     * @param Closure   $next
     *
     * @return mixed
     */
    public function handle(Exception $e, Closure $next)
    {
        //TODO implement logging

        return $next($e);
    }
}