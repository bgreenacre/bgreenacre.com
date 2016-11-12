<?php

namespace Bgreenacre\Posts;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Bgreenacre\Interfaces\EloquentValidationInterface;
use Bgreenacre\Traits\EloquentRulesAndErrorsTrait;
use Carbon\Carbon;

class PostModel extends Model implements EloquentValidationInterface {

    use EloquentRulesAndErrorsTrait;
    use Sluggable;

    protected $table = 'posts';
    protected $softDelete = true;
    protected $hidden = array(
        'author_id',
        'type_id',
    );

    public function type()
    {
        return $this->belongsTo('Bgreenacre\Types\TypeModel', 'type_id');
    }

    public function author()
    {
        return $this->belongsTo('Bgreenacre\Users\UserModel', 'author_id');
    }

    public function scopeByType($query, $type)
    {
        $query->whereHas(
            'type',
            function($innerQuery) use ($type)
            {
                if (is_numeric($type))
                {
                    $innerQuery->where('id', $type);
                }
                else
                {
                    $innerQuery->where('context', 'post')
                        ->where('name', $type);
                }
            }
        );
    }

    public function scopePublished($query)
    {
        $query->where('status', 'publish')
            ->where('publish_date', '<=', Carbon::now());
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getDates()
    {
        return array('created_at', 'updated_at', 'deleted_at', 'publish_date');
    }

}