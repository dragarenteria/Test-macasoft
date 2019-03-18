<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;



class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre1', 'email', 'password','nombre2','apellido1','apellido2','avatar','identificacion'
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

    protected $appends = ['full_name'];


    public  function getFullNameAttribute(){
        return ucfirst($this->nombre1).' '.ucfirst($this->nombre2.' '.ucfirst($this->apellido1.' '.ucfirst($this->apellido2)));
    }

    public function roles_relacion()
        {
            
            return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
        }
}
