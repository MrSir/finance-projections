<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'category_id',
        'type',
        'name',
        'description',
        'amount',
        'date',
        'frequency',
        'repeat_start',
        'repeat_end'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
