<?php namespace Bgreenacre\Types;

use Bgreenacre\Observers\EloquentValidatorObserver;

class TypeValidator extends EloquentValidatorObserver {

    public function getRules($model)
    {
        return [
        	'name' => [
        		'required',
        		'max:128',
        	],
        	'context' => [
        		'required',
        		'max:128',
        	],
        ];
    }

}