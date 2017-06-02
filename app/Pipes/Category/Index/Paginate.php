<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Category\Index;

use App\Exceptions\Category\Index\Paginate as ExceptionPaginate;
use App\Pipes\Index\Paginate as IndexPaginate;

/**
 * Class Paginate
 * @package App\Pipes\Category\Index
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
