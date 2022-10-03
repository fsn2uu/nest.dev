<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Company extends Model
{
    use Billable;

    protected $fillable = [
        'name',
        'address',
        'address2',
        'city',
        'zip',
        'state',
        'phone',
        'phone2',
        'toll_free',
        'website',
        'logo',
        'status',
    ];

    protected $hidden = [
        'password',
        'api_token',
        'stripe_id',
        'stripe_bank_id',
        'stripe_account_id',
        'card_brand',
        'card_last_four',
    ];

    public function taxPercentage()
    {
        return 6;
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function complexes()
    {
        return $this->hasMany('App\Complex')->orderBy('name');
    }

    public function units()
    {
        return $this->hasMany('App\Unit');
    }

    public function travelers()
    {
        return $this->belongsToMany('App\Traveler')->orderBy('last');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function rate_table()
    {
        return $this->hasOne('\App\RateTable')->whereNull('complex_id')->whereNull('unit_id');
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
