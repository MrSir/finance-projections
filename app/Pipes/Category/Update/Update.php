<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Category\Update;

use App\Exceptions\Category\Update\Update as ExceptionUpdate;
use App\Pipes\Update\Update as UpdateUpdate;
use App\Passables\Category\Update as PassableUpdate;
use Closure;
use Throwable;

/**
 * Class Create
 * @package App\Pipes\Category\Update
 */
class Update extends UpdateUpdate
{
    /**
     * Search constructor.
     */
    public function __construct()
    {
        parent::__construct(
            ExceptionUpdate::class,
            'Category update failed.'
        );
    }

    /**
     * @param PassableUpdate  $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws ExceptionUpdate
     */
    public function handle(PassableUpdate &$passable, Closure $next)
    {
        try {
            $this->updateModel($passable);
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
