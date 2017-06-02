<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Index;

use App\Exceptions\Transaction\Index\Sort as ExceptionSort;
use App\Pipes\Index\Sort as IndexSort;

/**
 * Class Sort
 * @package App\Pipes\Transaction\Index
 */
class Sort extends IndexSort
{
    /**
     * Paginate constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionSort::class);
    }
}
