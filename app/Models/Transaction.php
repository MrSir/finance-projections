<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';

    protected $dates = [
        'occurred_at',
        'repeat_start_at',
        'repeat_end_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'account_id',
        'destination_account_id',
        'category_id',
        'transaction_frequency_id',
        'name',
        'description',
        'amount',
        'occurred_at',
        'repeat_start_at',
        'repeat_end_at'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function destinationAccount()
    {
        return $this->belongsTo(Account::class, 'destination_account_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function frequency()
    {
        return $this->belongsTo(Transaction\Frequency::class, 'transaction_frequency_id', 'id');
    }
}
