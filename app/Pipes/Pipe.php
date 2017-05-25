<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/24/2017
 * Time: 10:05 AM
 */

namespace App\Pipes;

use Exception;

/**
 * Class Pipe
 * @package App\Pipes
 */
abstract class Pipe
{
    /**
     * @var string
     */
    protected $exceptionType = Exception::class;

    /**
     * @var string
     */
    protected $exceptionMessage = 'Failed.';

    /**
     * Pipe constructor.
     *
     * @param $exceptionType
     * @param $exceptionMessage
     */
    public function __construct($exceptionType, $exceptionMessage)
    {
        $this->setExceptionType($exceptionType);
        $this->setExceptionMessage($exceptionMessage);
    }

    /**
     * @return string
     */
    public function getExceptionType()
    {
        return $this->exceptionType;
    }

    /**
     * @param string $exceptionType
     */
    public function setExceptionType($exceptionType)
    {
        $this->exceptionType = $exceptionType;
    }

    /**
     * @return string
     */
    public function getExceptionMessage()
    {
        return $this->exceptionMessage;
    }

    /**
     * @param string $exceptionMessage
     */
    public function setExceptionMessage($exceptionMessage)
    {
        $this->exceptionMessage = $exceptionMessage;
    }
}
