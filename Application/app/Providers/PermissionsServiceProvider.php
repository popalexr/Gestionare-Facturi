<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $permissions = $this->getPermissions();

        foreach ($permissions as $permission) {
            Gate::define($permission, function ($user) use ($permission) {
                if ($user->isAdmin())
                    return true;

                return $user->hasPermission($permission);
            });
        }
    }

    /**
     * Get the list of all permissions from config.
     * 
     * @return array
     */
    public function getPermissions(): array
    {
        $permissions = [];

        foreach (config('permissions') as $permissions_list) {
            foreach ($permissions_list as $permission => $description) {
                $permissions[] = $permission;
            }
        }

        return $permissions;
    }
}
