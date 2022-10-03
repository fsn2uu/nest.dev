<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'company_id',
        'complex_id',
        'unit_id',
        'title',
        'per_night',
        'amount',
    ];

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

    public function scopeFilter($query, $value = [])
    {
        if(is_array($value)):
            foreach($value as $k => $v):
                if($k != '_token' && $k != '_method'):
                    if($v != ''):
                        if(strstr($k, '|')):
                            $k = explode('|', $k);
                            $operator = $k[1];
                            $k = $k[0];
                        else:
                            $operator = '=';
                        endif;

                        if($operator == 'LIKE')
                        {
                            $v = '%'.str_replace(' ', '%', $v).'%';
                        }

                        return $query->where($k, $operator, $v);
                    endif;
                endif;
            endforeach;
        endif;
    }
}
