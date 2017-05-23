<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 11:09 AM
 */

namespace App\Interfaces\Passables;

interface Index extends Base
{
    public function getQuery();
    public function setQuery($query);

    public function getPerPage();
    public function setPerPage($perPage);

    public function getPage();
    public function setPage($page);

    public function getResults();
    public function setResults($results);

    public function getTotals();
    public function setTotals($totals);
}