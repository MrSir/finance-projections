<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:42 AM
 */

namespace App\Passables;

use App\Interfaces\Passables\Index as PassableIndex;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;

/**
 * Class Index
 * @package App\Passables
 */
class Index extends Base implements PassableIndex
{
    /**
     * @var Builder
     */
    protected $query;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * @var int
     */
    protected $page;

    /**
     * @var Collection
     */
    protected $results;

    /**
     * @var int
     */
    protected $totals;

    /**
     * @return Builder
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param Builder $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return Collection
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param Collection $results
     */
    public function setResults($results)
    {
        $this->results = $results;
    }

    /**
     * @return int
     */
    public function getTotals()
    {
        return $this->totals;
    }

    /**
     * @param int $totals
     */
    public function setTotals($totals)
    {
        $this->totals = $totals;
    }
}
