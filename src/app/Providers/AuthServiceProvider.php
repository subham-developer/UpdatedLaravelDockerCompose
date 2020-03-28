<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        // Project::class => RolePolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', 'App\Policies\RolePolicy@isAdmin');
        Gate::define('ngo', 'App\Policies\RolePolicy@isNgo');
        Gate::define('permission', 'App\Policies\PermissionPolicy@hasPermission');
        Gate::define('editor', 'App\Policies\EditorPolicy@hasPermission');
        Gate::define('project', 'App\Policies\RolePolicy@canModifyProject');
    }


}
