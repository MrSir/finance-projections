<?php

namespace App\Models\Account;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use SoftDeletes;

    protected $table = 'account_balances';

    protected $dates = [
        'posted_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'balance',
        'posted_at'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
