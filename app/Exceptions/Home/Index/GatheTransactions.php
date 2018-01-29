<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Home\Index;

use Exception;
use Throwable;

/**
 * Class Search
 * @package App\Exceptions\Home\Index
 */
class GatherTransactions extends Exception
{
    /**
     * Search constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'Transaction gather failed.',
            500,
            $previous
        );
    }
}
