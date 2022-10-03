<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation;

class Unit extends Model
{
    protected $fillable = [
        'company_id',
        'complex_id',
        'name',
        'address',
        'address2',
        'city',
        'state',
        'zip',
        'description',
        'status',
        'pet_friendly',
    ];

    public function amenities()
    {
        return $this->morphToMany('\App\Amenity', 'amenable');
    }

    public function rate_table()
    {
        return $this->hasOne('\App\RateTable');
    }

    public function scopeFilter($query, $value = [])
    {
        if(is_array($value)):
            foreach($value as $k => $v):
                if($k != '_token' && $k != '_method' && $k != 'start_date' && $k != 'end_date'):
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

    public function scopeAvailable($query, $value = [])
    {
        if(@$value['start_date'] && @$value['end_date']):
            //get all reservations between dates:
            $reserved = [];
            $reserves = Reservation::whereBetween('start_date', [$value['start_date'], $value['end_date']])->orWhereBetween('end_date', [$value['start_date'], $value['end_date']])->get();
            foreach($reserves as $res)
            {
                $reserved[] = $res->id;
            }
            return $query->whereNotIn('id', $reserved);
        endif;
    }

    public function complex()
    {
        return $this->belongsTo('App\Complex');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function photos()
    {
        return $this->hasMany('\App\Photo');
    }

    public function reservations()
    {
        return $this->hasMany('\App\Reservation');
    }
}
