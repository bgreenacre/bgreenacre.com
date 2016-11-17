<?php namespace Bgreenacre\Users;

use Bgreenacre\Observers\EloquentValidatorObserver;

class UserValidator extends EloquentValidatorObserver {

    public function getRules($model)
    {
        return [
        	'username' => [
        		'required',
        		'max:255',
        		'unique:users,username,' . $model->id,
        	],
        	'email' => [
        		'required',
        		'max:255',
        		'email',
        		'unique:users,email,' . $model->id,
        	],
        	'password' => [
        		'required',
        		'max:255',
        	],
        	'first_name' => [
        		'max:255',
        	],
        	'last_name' => [
        		'max:255',
        	],
        ];
    }

}