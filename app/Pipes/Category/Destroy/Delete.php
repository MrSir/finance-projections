<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Category\Destroy;

use App\Exceptions\Category\Destroy\Delete as ExceptionDelete;
use App\Pipes\Destroy\Delete as DestroyDelete;
use App\Passables\Category\Destroy as PassableDestroy;
use Closure;
use Throwable;

/**
 * Class Delete
 * @package App\Pipes\Category\Destroy
 */
class Delete extends DestroyDelete
{
    /**
     * Search constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionDelete::class);
    }

    /**
     * @param PassableDestroy  $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws ExceptionDelete
     */
    public function handle(PassableDestroy &$passable, Closure $next)
    {
        try {
            $this->deleteModel($passable);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
