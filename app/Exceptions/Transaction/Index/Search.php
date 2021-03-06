<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Transaction\Index;

use Exception;
use Throwable;

/**
 * Class Search
 * @package App\Exceptions\Transaction\Index
 */
class Search extends Exception
{
    /**
     * Search constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'Transaction search failed.',
            500,
            $previous
        );
    }
}
