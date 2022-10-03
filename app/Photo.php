<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'company_id',
        'complex_id',
        'unit_id',
        'filename',
        'order',
        'alt',
        'title',
    ];

    public function scopeMine($query)
    {
        return $query->where('company_id', \Auth::user()->company_id);
    }

    public function complex()
    {
        return $this->belongsTo('\App\Complex');
    }

    public function unit()
    {
        return $this->belongsTo('\App\Complex');
    }
}
