<?php namespace Bgreenacre\Posts;

use Bgreenacre\Observers\EloquentValidatorObserver;

class PostValidator extends EloquentValidatorObserver {

    public function getRules($model)
    {
        return [
        	'author_id' => [
        		'integer',
        	],
        	'type_id' => [
        		'required',
        		'integer',
        	],
        	'status'  => [
        		'required',
        		'max:32',
        		'in:draft,publish,private',
        	],
        	'slug'    => [
        		'required',
        		'max:255',
                'unique:posts,slug,' . $model->id,
        	],
        	'title'   => [
        		'required',
        		'max:255',
        	],
        	'content'    => [
        		'required',
        		'max:65535',
        	],
        	'publish_date' => [
        		'required',
        		'date',
        	],
        ];
    }

}