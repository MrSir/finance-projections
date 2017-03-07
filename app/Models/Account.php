<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

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
