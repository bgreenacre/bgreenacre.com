<?php

namespace Bgreenacre\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bgreenacre\Interfaces\EloquentValidationInterface;
use Bgreenacre\Traits\EloquentRulesAndErrorsTrait;

class UserModel extends Authenticatable implements EloquentValidationInterface
{
    use Notifiable;
    use EloquentRulesAndErrorsTrait;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('Bgreenacre\Roles\RoleModel', 'users_roles', 'user_id', 'role_id');
    }

}
