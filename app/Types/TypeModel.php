<?php

namespace Bgreenacre\Types;

use Illuminate\Database\Eloquent\Model;
use Bgreenacre\Interfaces\EloquentValidationInterface;
use Bgreenacre\Traits\EloquentRulesAndErrorsTrait;

class TypeModel extends Model implements EloquentValidationInterface
{

    use EloquentRulesAndErrorsTrait;

    protected $table = 'types';
    public $timestamps = false;

    public function scopeForPosts($query)
    {
    	return $query->where('context', 'post');
    }

}
