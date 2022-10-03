<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [];

    public function rate_table()
    {
        return $this->belongsTo('\App\RateTable');
    }
}
