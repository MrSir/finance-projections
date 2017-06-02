<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Update;

use App\Exceptions\Transaction\Update\Update as ExceptionUpdate;
use App\Pipes\Update\Update as UpdateUpdate;
use App\Passables\Transaction\Update as PassableUpdate;
use Closure;
use Throwable;

/**
 * Class Update
 * @package App\Pipes\Transaction\Update
 */
class Update extends UpdateUpdate
{
    /**
     * Search constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionUpdate::class);
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
\Log::critical($e->getMessage());
            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
