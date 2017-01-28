<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description'
    ];

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
