<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateTable extends Model
{
    protected $fillable = [];

    public function rates()
    {
        return $this->hasMany('\App\Rate');
    }

    public function company()
    {
        return $this->belongsTo('\App\Company');
    }

    public function complex()
    {
        return $this->belongsTo('\App\Complex');
    }

    public function unit()
    {
        return $this->belongsTo('\App\Unit');
    }

    public function scopeMine($query)
    {
        return $query->where('company_id', \Auth::user()->company_id);
    }
}
