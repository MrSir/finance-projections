<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Account\Index;

use App\Exceptions\Account\Index\Format as ExceptionFormat;
use App\Pipes\Index\Format as IndexFormat;

/**
 * Class Format
 * @package App\Pipes\Account\Index
 */
class Format extends IndexFormat
{
    /**
     * Format constructor.
     */
    public function __construct()
    {
        parent::__construct(
            ExceptionFormat::class,
            'Account format failed.'
        );
    }
}
