<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Category\Update;

use App\Exceptions\Category\Update\Format as ExceptionFormat;
use App\Pipes\Update\Format as UpdateFormat;

/**
 * Class Format
 * @package App\Pipes\Category\Update
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
