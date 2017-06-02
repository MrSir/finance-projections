<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Frequency\Index;

use App\Exceptions\Transaction\Frequency\Index\Format as ExceptionFormat;
use App\Pipes\Index\Format as IndexFormat;

/**
 * Class Format
 * @package App\Pipes\Transaction\Frequency\Index
 */
class Format extends IndexFormat
{
    /**
     * Format constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionFormat::class);
    }
}
