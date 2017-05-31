<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Store;

use App\Exceptions\Transaction\Store\Create as ExceptionCreate;
use App\Models\Transaction;
use App\Passables\Transaction\Store;
use App\Pipes\Store\Create as StoreCreate;
use Closure;
use Throwable;

/**
 * Class Create
 * @package App\Pipes\Transaction\Store
 */
class Create extends StoreCreate
{
    /**
     * Search constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionCreate::class);

        $this->setModel(Frequency::class);
    }

    /**
     * @param Store   $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws ExceptionCreate
     */
    public function handle(Store &$passable, Closure $next)
    {
        try {
            $this->storeModel($passable);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
