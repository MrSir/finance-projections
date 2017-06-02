<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Transaction\Frequency\Destroy;

use Exception;
use Throwable;

/**
 * Class Delete
 * @package App\Exceptions\Transaction\Frequency\Destroy
 */
class Delete extends Exception
{
    /**
     * Update constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'Frequency delete failed.',
            500,
            $previous
        );
    }
}
