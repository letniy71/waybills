<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login',
        'idRole',
        'idBrigade',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {   
    return $this->belongsTo('\App\Models\Role', 'idRole','idRole');
    }

    public function brigade()
    {   
    return $this->belongsTo('\App\Models\Brigade', 'idBrigade','idBrigade');
    }

//Берем из таблицы ролей admin

    public function isAdmin()
    {
       return $this->role()->where('name', 'admin')->first();
    }
}
