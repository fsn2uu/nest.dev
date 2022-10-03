<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traveler extends Model
{
    protected $fillable = [
        'first',
        'last',
        'email',
        'phone',
        'phone2',
        'address',
        'address2',
        'city',
        'state',
        'zip',
        'stripe_customer_id',
    ];

    public function companies()
    {
        return $this->belongsToMany('App\Company');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation')->where('company_id', \Auth::user()->company->id);
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
