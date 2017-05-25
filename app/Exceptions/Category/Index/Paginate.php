<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Category\Index;

use Exception;
use Throwable;

/**
 * Class Paginate
 * @package App\Exceptions\Category\Index
 */
class Paginate extends Exception
{
    /**
     * Paginate constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'Category paginate failed.',
            500,
            $previous
        );
    }
}