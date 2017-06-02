<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Transaction\Frequency\Index;

use Exception;
use Throwable;

/**
 * Class Sort
 * @package App\Exceptions\Transaction\Frequency\Index
 */
class Sort extends Exception
{
    /**
     * Sort constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'Frequency sort failed.',
            500,
            $previous
        );
    }
}
