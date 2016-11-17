<?php namespace Bgreenacre\TaxonomyTerms;

use Bgreenacre\Observers\EloquentValidatorObserver;

class TaxonomyTermValidator extends EloquentValidatorObserver {

    public function getRules($model)
    {
        return [];
    }

}