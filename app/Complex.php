<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'address',
        'address2',
        'city',
        'state',
        'zip',
        'description',
        'phone',
        'phone2',
        'toll_free',
        'website',
    ];

    public function units()
    {
        return $this->hasMany('App\Unit');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function rate_table()
    {
        return $this->hasOne('\App\RateTable');
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

    public function scopeMine($query)
    {
        return $query->where('company_id', \Auth::user()->company_id);
    }

    public function photos()
    {
        return $this->hasMany('\App\Photo')->orderBy('order');
    }

    public function amenities()
    {
        return $this->morphToMany('\App\Amenity', 'amenable');
    }
}
