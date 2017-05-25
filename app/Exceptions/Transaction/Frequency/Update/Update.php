<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Transaction\Frequency\Update;

use Exception;
use Throwable;

/**
 * Class Update
 * @package App\Exceptions\Transaction\Frequency\Update
 */
class Update extends Exception
{
    /**
     * Update constructor.
     *
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct(
            'Frequency update failed.',
            500,
            $previous
        );
    }
}
