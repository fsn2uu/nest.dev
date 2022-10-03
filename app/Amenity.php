<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];

    public function amenable()
    {
        return $this->morphTo();
    }

    public function units()
    {
        return $this->morphedByMany('App\Unit', 'amenable');
    }

    public function complexes()
    {
        return $this->morphedByMany('App\Unit', 'amenable');
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
