<?php

namespace Tohuma\Laravel\Routes\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use File;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $appName = $this->app->getNamespace();
        $namespace = "{$appName}Http\\Controllers";
        $path = app_path( DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers');
        $directories = File::directories( $path );

        $namespaces = $this->builNamespaceRoutes($namespace, $directories);
        $this->mapApplicationRoutes($router, $namespaces);
    }

    /**
     * Define the "application" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapApplicationRoutes(Router $router, $namespaces)
    {
        foreach( $namespaces as $prefix => $namespace ) {
            $groupname = substr( $namespace, strrpos($namespace, '\\') + 1, strlen($namespace) );

            $router->group(['prefix' => $prefix, 'namespace' => $namespace], function ($router) use ($prefix, $groupname) {

                require app_path("Http/Controllers/{$groupname}/routes.php");
            });
        }
    }

    /**
     * Build namespaces routes for the application.
     *
     * @return array
     */
    protected function builNamespaceRoutes($namespace, $directories)
    {
        $namespaces = [];
        $path = app_path( DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers');

        foreach( $directories as $directory ) {
            $filename = "{$directory}" . DIRECTORY_SEPARATOR . "routes.php";

            if( File::exists($filename) ) {
                $groupname = substr( $directory, strrpos($directory, DIRECTORY_SEPARATOR) + 1, strlen($directory) );
                $prefix = strtolower( $groupname );
                $namespaces[$prefix] = "{$namespace}\\{$groupname}";
            }
        }

        return $namespaces;
    }

}
