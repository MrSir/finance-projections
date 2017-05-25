<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Account\Index;

use App\Exceptions\Account\Index\Search as ExceptionSearch;
use App\Models\Account;
use App\Passables\Account\Index;
use App\Pipes\Index\Search as IndexSearch;
use Closure;
use Throwable;

/**
 * Class Search
 * @package App\Pipes\Account\Index
 */
class Search extends IndexSearch
{
    /**
     * Search constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionSearch::class);

        $this->setModel(Account::class);
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

            $passable->setQuery($query);
        } catch (Throwable $e) {
            $exceptionType = $this->getExceptionType();

            throw new $exceptionType($e);
        }

        return $next($passable);
    }
}
