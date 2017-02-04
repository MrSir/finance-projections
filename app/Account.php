<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
        'name',
        'description'
    ];

    public function accountBalances()
    {
        return $this->hasMany(AccountBalances::class);
    }
}
