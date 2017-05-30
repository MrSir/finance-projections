<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Index;

use App\Exceptions\Transaction\Index\Search as ExceptionSearch;
use App\Models\Transaction;
use App\Passables\Transaction\Index;
use App\Pipes\Index\Search as IndexSearch;
use Closure;
use Throwable;

/**
 * Class Search
 * @package App\Pipes\Transaction\Index
 */
class Search extends IndexSearch
{
    /**
     * Search constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionSearch::class);

        $this->setModel(Transaction::class);
    }

    /**
     * @param Index   $passable
     * @param Closure $next
     *
     * @return mixed
     * @throws ExceptionSearch
     */
    public function handle(Index &$passable, Closure $next)
    {
        try {
            $this->buildQuery($passable);

            $query = $passable->getQuery();
            $request = $passable->getRequest();

            if ($request->has('name')) {
                $query->where(
                    'name',
                    'LIKE',
                    '%' . $request->get('name') . '%'
                );
            }

            if ($request->has('description')) {
                $query->where(
                    'description',
                    'LIKE',
                    '%' . $request->get('description') . '%'
                );
            }

            if ($request->has('accountId')) {
                $query->where(
                    'account_id',
                    '=',
                    $request->get('accountId')
                );
            }

            if ($request->has('destinationAccountId')) {
                $query->where(
                    'destination_account_id',
                    '=',
                    $request->get('destinationAccountId')
                );
            }

            if ($request->has('categoryId')) {
                $query->where(
                    'category_id',
                    '=',
                    $request->get('categoryId')
                );
            }

            if ($request->has('transactionFrequencyId')) {
                $query->where(
                    'transaction_frequency_id',
                    '=',
                    $request->get('transactionFrequencyId')
                );
            }

            if ($request->has('occurredAtFrom')) {
                $query->where(
                    'occurred_at',
                    '>=',
                    $request->get('occurredAtFrom') . ' 00:00:00'
                );
            }

            if ($request->has('occurredAtTo')) {
                $query->where(
                    'occurred_at',
                    '<=',
                    $request->get('occurredAtTo') . ' 23:59:59'
                );
            }

            $passable->setQuery($query);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
