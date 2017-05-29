<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 2:31 PM
 */

namespace App\Exceptions\Account\Destroy;

use Exception;
use Throwable;

/**
 * Class Delete
 * @package App\Exceptions\Account\Destroy
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
            'Account delete failed.',
            500,
            $previous
        );
    }
}
