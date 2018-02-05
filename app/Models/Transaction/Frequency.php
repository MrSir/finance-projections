<?php

namespace App\Models\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frequency extends Model
{
    use SoftDeletes;

    protected $table = 'transaction_frequencies';

    protected $fillable = [
        'name',
        'description'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'transaction_frequency_id', 'id');
    }
}
