<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Index;

use App\Exceptions\Transaction\Index\Paginate as ExceptionPaginate;
use App\Pipes\Index\Paginate as IndexPaginate;

/**
 * Class Paginate
 * @package App\Pipes\Transaction\Index
 */
class Paginate extends IndexPaginate
{
    /**
     * Paginate constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionPaginate::class);
    }
}
