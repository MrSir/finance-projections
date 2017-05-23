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
 * Class Format
 * @package App\Steps
 */
class Format
{
    /**
     * @param Exception $e
     * @param Closure   $next
     *
     * @return mixed
     */
    public function handle(Exception $e, Closure $next)
    {
        return $next(
            [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]
        );
    }
}
