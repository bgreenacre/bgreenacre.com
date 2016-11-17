<?php

namespace Bgreenacre\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindObservers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function bindObservers()
    {
        \Bgreenacre\Posts\PostModel::observe($this->app->make('\Bgreenacre\Posts\PostValidator'));
        \Bgreenacre\Roles\RoleModel::observe($this->app->make('\Bgreenacre\Roles\RoleValidator'));
        \Bgreenacre\TaxonomyTerms\TaxonomyTermModel::observe($this->app->make('\Bgreenacre\TaxonomyTerms\TaxonomyTermValidator'));
        \Bgreenacre\Types\TypeModel::observe($this->app->make('\Bgreenacre\Types\TypeValidator'));
        \Bgreenacre\Users\UserModel::observe($this->app->make('\Bgreenacre\Users\UserValidator'));
    }

}
