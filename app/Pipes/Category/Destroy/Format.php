<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:57 AM
 */

namespace App\Pipes\Category\Destroy;

use App\Exceptions\Category\Destroy\Format as ExceptionFormat;
use App\Pipes\Destroy\Format as DestroyFormat;

/**
 * Class Format
 * @package App\Pipes\Category\Destroy
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
