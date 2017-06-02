<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Transaction\Update;

use App\Exceptions\Transaction\Update\Format as ExceptionFormat;
use App\Pipes\Update\Format as UpdateFormat;

/**
 * Class Format
 * @package App\Pipes\Transaction\Update
 */
class Format extends UpdateFormat
{
    /**
     * Format constructor.
     */
    public function __construct()
    {
        parent::__construct(ExceptionFormat::class);
    }
}
