<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Update;

use App\Interfaces\Passables\Update;
use App\Pipes\Pipe;
use Closure;
use Exception;
use Throwable;

/**
 * Class Format
 * @package App\Pipes\Update
 */
abstract class Format extends Pipe
{
    /**
     * @param Update  $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws Exception
     */
    public function handle(Update &$passable, Closure $next)
    {
        try {
            $response = [
                'code' => 200,
                'results' => $passable->getModel(),
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
