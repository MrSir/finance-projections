<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Frequency\Index;

use App\Exceptions\Transaction\Frequency\Search as ExceptionSearch;
use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Index;
use App\Pipes\Index\Search as IndexSearch;
use Closure;
use Throwable;

/**
 * Class Search
 * @package App\Pipes\Transaction\Frequency\Index
 */
class Search extends IndexSearch
{
    /**
     * Search constructor.
     */
    public function __construct()
    {
        parent::__construct(
            ExceptionSearch::class,
            'Frequency search failed.'
        );

        $this->setModel(Frequency::class);
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

            throw new $exceptionType(
                $this->getExceptionMessage(),
                500,
                $e
            );
        }

        return $next($passable);
    }
}