<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Category\Store;

use Exception;
use Throwable;

/**
 * Class Create
 * @package App\Exceptions\Category\Store
 */
class Create extends Exception
{
    /**
     * Create constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'Category create failed.',
            500,
            $previous
        );
    }
}
