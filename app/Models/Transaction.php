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
        'category_id',
        'transaction_frequency_id',
        'is_credit',
        'is_debit',
        'name',
        'description',
        'amount',
        'occurred_at',
        'repeat_start_at',
        'repeat_end_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function frequency()
    {
        return $this->belongsTo(Transaction\Frequency::class);
    }
}
