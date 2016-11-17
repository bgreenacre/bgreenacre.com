<?php namespace Bgreenacre\Roles;

use Bgreenacre\Observers\EloquentValidatorObserver;

class RoleValidator extends EloquentValidatorObserver {

    public function getRules($model)
    {
        return [
        	'name' => [
        		'required',
        		'max:255',
        	],
        	'slug' => [
        		'required',
        		'max:255',
        		'unique:roles,slug,' . $model->id,
        	],
        ];
    }

}