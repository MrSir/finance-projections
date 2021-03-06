<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Account\Update;

use App\Exceptions\Account\Update\Update as ExceptionUpdate;
use App\Pipes\Update\Update as UpdateUpdate;
use App\Passables\Account\Update as PassableUpdate;
use Carbon\Carbon;
use Closure;
use Throwable;

/**
 * Class Create
 * @package App\Pipes\Account\Update
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

            $balance = $passable->getRequest()->get('balance');
            $account = $passable->getModel();

            $account->accountBalances()->create(
                [
                    'balance' => $balance,
                    'posted_at' => Carbon::now()
                ]
            );
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
