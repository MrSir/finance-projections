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
            'account_id' => 'integer',
            'destination_account_id' => 'integer',
            'category_id' => 'integer',
            'transaction_frequency_id' => 'integer',
            'is_credit' => 'boolean',
            'is_debit' => 'boolean',
            'name' => 'string',
            'description' => 'string',
            'amount' => 'numeric',
            'occurred_at' => 'date',
            'repeat_start_at' => 'date',
            'repeat_end_at' => 'date',
        ];
    }
}
