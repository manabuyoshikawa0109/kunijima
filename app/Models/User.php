<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
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
    protected $casts = [];

    /**
    * フルネームを返す
    *
    * @return string
    */
    public function fullName()
    {
        return $this->last_name . $this->first_name;
    }

    /**
    * フルネームカナを返す
    *
    * @return string
    */
    public function fullNameKana()
    {
        return $this->last_name_kana . $this->first_name_kana;
    }
}
