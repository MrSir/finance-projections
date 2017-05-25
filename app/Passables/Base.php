<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:42 AM
 */

namespace App\Passables;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\Passables\Base as PassableBase;

/**
 * Class Base
 * @package App\Passables
 */
class Base implements PassableBase
{
    /**
     * @var FormRequest
     */
    protected $request;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var Exception
     */
    protected $exception;

    /**
     * @var array
     */
    protected $response;

    /**
     * @return FormRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param FormRequest $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Exception $exception
     */
    public function setException($exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param array $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
