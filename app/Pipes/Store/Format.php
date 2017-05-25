<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Store;

use App\Interfaces\Passables\Store;
use App\Pipes\Pipe;
use Closure;
use Exception;
use Throwable;

/**
 * Class Format
 * @package App\Pipes\Store
 */
abstract class Format extends Pipe
{
    /**
     * @param Store   $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws Exception
     */
    public function handle(Store &$passable, Closure $next)
    {
        try {
            $response = [
                'code' => 200,
                'results' => $passable->getModel(),
            ];

            $passable->setResponse($response);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
