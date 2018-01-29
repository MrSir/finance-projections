<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Home\Index;

use App\Exceptions\Home\Index\GatherTransactions as ExceptionGatherTransactions;
use App\Models\Transaction\Frequency;
use App\Passables\Home\Index;
use App\Pipes\Pipe;
use Closure;
use Throwable;

/**
 * Class Search
 * @package App\Pipes\Home\Index
 */
class GatherTransactions extends Pipe
{
    /**
     * Search constructor.
     */
    public function __construct()
    {

        parent::__construct(ExceptionGatherTransactions::class);
    }

    /**
     * @param Index   $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws ExceptionGatherTransactions
     */
    public function handle(Index &$passable, Closure $next)
    {
        try {
            $frequencies = Frequency::all();

            foreach($frequencies as $frequency) {
                $frequency->load('transactions');
            }

            $passable->setFrequencies($frequencies);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
