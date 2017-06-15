<?php
/**
 * Created by PhpStorm.
 * User: MrSir
 * Date: 1/29/2017
 * Time: 7:33 PM
 */

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'account_id' => 'required|integer|exists:accounts,id',
            'destination_account_id' => 'sometimes|required|integer|exists:accounts,id',
            'category_id' => 'required|integer|exists:categories,id',
            'transaction_frequency_id' => 'required|integer|exists:transaction_frequencies,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'occurred_at' => 'required|date',
            'repeat_start_at' => 'required|date',
            'repeat_end_at' => 'sometimes|required|date',
        ];
    }
}
