<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 11:09 AM
 */

namespace App\Interfaces\Passables;

/**
 * Interface Index
 * @package App\Interfaces\Passables
 */
interface Index extends Base
{
    /**
     * @return mixed
     */
    public function getQuery();

    /**
     * @param $query
     *
     * @return mixed
     */
    public function setQuery($query);

    /**
     * @return mixed
     */
    public function getPerPage();

    /**
     * @param $perPage
     *
     * @return mixed
     */
    public function setPerPage($perPage);

    /**
     * @return mixed
     */
    public function getPage();

    /**
     * @param $page
     *
     * @return mixed
     */
    public function setPage($page);

    /**
     * @return mixed
     */
    public function getResults();

    /**
     * @param $results
     *
     * @return mixed
     */
    public function setResults($results);

    /**
     * @return mixed
     */
    public function getTotals();

    /**
     * @param $totals
     *
     * @return mixed
     */
    public function setTotals($totals);
}
