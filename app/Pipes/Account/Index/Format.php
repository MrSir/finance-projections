<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Account\Index;

use App\Exceptions\Account\Index\Format as ExceptionFormat;
use App\Interfaces\Passables\Index;
use App\Pipes\Index\Format as IndexFormat;
use Closure;

/**
 * Class Format
 * @package App\Pipes\Account\Index
 */
class Format extends IndexFormat
{
    /**
     * Format constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionFormat::class);
    }

    /**
     * @param Index $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle(Index &$passable, Closure $next)
    {
        $result = $passable->getResults();

        $result->each(
            function (&$account) {
                $account->account_balances = $account->accountBalances()
                    ->orderBy(
                        'posted_at',
                        'desc'
                    )
                    ->get();
            }
        );

        $passable->setResults($result);

        return parent::handle(
            $passable,
            $next
        );
    }
}
