<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company_id', 'email', 'password', 'phone', 'phone2',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function complex()
    {
        return $this->belongsTo('App\Complex');
    }

    public function package()
    {
        if($this->company->subscribed('Nest VRM', 'hobbyist'))
        {
            return 'hobbyist';
        }
        elseif($this->company->subscribed('Nest VRM', 'beginner'))
        {
            return 'beginner';
        }
        elseif($this->company->subscribed('Nest VRM', 'pro'))
        {
            return 'pro';
        }
        elseif($this->company->subscribed('Nest VRM', 'enterprise'))
        {
            return 'enterprise';
        }
    }

    public function complex_unit_limit()
    {
        if($this->package() == 'hobbyist')
        {
            return 3;
        }
        elseif($this->package() == 'beginner')
        {
            return 10;
        }
        elseif($this->package() == 'pro')
        {
            return 30;
        }
        elseif($this->package() == 'enterprise')
        {
            return 0;
        }
    }

    public function user_limit()
    {
        if($this->package() == 'hobbyist')
        {
            return 5;
        }
        elseif($this->package() == 'beginner')
        {
            return 10;
        }
        elseif($this->package() == 'pro')
        {
            return 15;
        }
        elseif($this->package() == 'enterprise')
        {
            return 0;
        }
    }

    public function photo_limit()
    {
        if($this->package() == 'hobbyist')
        {
            return 5;
        }
        elseif($this->package() == 'beginner')
        {
            return 10;
        }
        elseif($this->package() == 'pro')
        {
            return 30;
        }
        elseif($this->package() == 'enterprise')
        {
            return 50;
        }
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
}
