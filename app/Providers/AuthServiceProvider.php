<?php

namespace App\Providers;

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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('hrd-only', function ($user) {
            if ($user->karyawan->jabatan->level == 3) {
                return true;
            }
            else {
                return false;
            }
        });

        Gate::define('pimpinan', function ($user) {
            if ($user->karyawan->jabatan->level == 1 || $user->karyawan->jabatan->level == 2) {
                return true;
            }
            else {
                return false;
            }
        });
    }
}
