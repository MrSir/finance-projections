<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountBalances extends Model
{
    protected $table = 'account_balances';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'balance',
        'date'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
