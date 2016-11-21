<?php

namespace Bgreenacre\Roles;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Bgreenacre\Interfaces\EloquentValidationInterface;
use Bgreenacre\Traits\EloquentRulesAndErrorsTrait;

class RoleModel extends Model implements EloquentValidationInterface
{

    use EloquentRulesAndErrorsTrait;
    use Sluggable;

    protected $table = 'roles';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

}
