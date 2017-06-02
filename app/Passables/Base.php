<?php
/**
 * Created by PhpStorm.
 * User: mtochev
 * Date: 5/23/2017
 * Time: 9:42 AM
 */

namespace App\Passables;

use App\Interfaces\Passables\Base as PassableBase;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

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
