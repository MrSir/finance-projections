<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Frequency\Store;

use App\Exceptions\Transaction\Frequency\Store\Format as ExceptionFormat;
use App\Pipes\Store\Format as StoreFormat;

/**
 * Class Format
 * @package App\Pipes\Transaction\Frequency\Store
 */
class Format extends StoreFormat
{
    /**
     * Format constructor.
     */
    public function __construct()
    {
        parent::__construct(
            ExceptionFormat::class,
            'Frequency format failed.'
        );
    }
}
