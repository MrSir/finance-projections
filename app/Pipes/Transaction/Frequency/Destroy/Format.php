<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Frequency\Destroy;

use App\Exceptions\Transaction\Frequency\Destroy\Format as ExceptionFormat;
use App\Pipes\Destroy\Format as DestroyFormat;

/**
 * Class Format
 * @package App\Pipes\Transaction\Frequency\Destroy
 */
class Format extends DestroyFormat
{
    /**
     * Format constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionFormat::class);
    }
}
