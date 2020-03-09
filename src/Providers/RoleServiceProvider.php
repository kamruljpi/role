<?php

namespace kamruljpi\Role\Providers;

use Illuminate\Support\ServiceProvider;


class RoleServiceProvider extends ServiceProvider
{
    protected $commands = [
        'kamruljpi\Role\Console\Commands\RouteGenerate',
    ];
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $package_views = config("role.path.package_views");
        $package_migrations = config("role.path.package_migrations");
        $base_views = config("role.path.base_views");
        $base_migrations = config("role.path.base_migrations");
        $load_base_views = config("role.path.load_base_views");
        $load_base_migrations = config("role.path.load_base_migrations");
        $assets_path = config("role.path.package_assets");
        $base_assets_path = config("role.path.base_assets");
        $views_path = $package_views;
        if($load_base_views){
            $views_path = $base_views;
        }
        $migrations_path = $package_migrations;
        if($load_base_migrations){
            $migrations_path = $base_migrations;
        }
        $this->loadViewsFrom($views_path, 'role');
        
        $this->publishes([
                $package_views => $base_views,
            ]);
        $this->publishes([
                    $this->getConfigFile() => config_path('role.php'),
                ], 'config');

        $this->publishes([
                $package_migrations => $base_migrations
            ], 'migrations');

        $this->loadMigrationsFrom($migrations_path);

        $this->app['router']->aliasMiddleware('RoleAuthenticate', \kamruljpi\Role\Middleware\RoleAuthenticate::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
                $this->getConfigFile(),
                'role'
            );
        $this->commands($this->commands);
    }
    protected function getConfigFile()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'role.php';
    }
}
