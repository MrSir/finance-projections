<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Transaction\Frequency\Store;

use Exception;
use Throwable;

/**
 * Class Format
 * @package App\Exceptions\Transaction\Frequency\Store
 */
class Format extends Exception
{
    /**
     * Format constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'Frequency format failed.',
            500,
            $previous
        );
    }
}
