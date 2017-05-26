<?php
/**
 * Created by PhpStorm.
 * User: MrSir
 * Date: 1/29/2017
 * Time: 7:33 PM
 */

namespace App\Http\Requests\Transaction\Frequency;

use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'createdFrom' => 'date',
            'createdTo' => 'date'
        ];
    }
}
