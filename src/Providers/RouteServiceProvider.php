<?php

namespace Tohuma\Laravel\Routes\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Tohuma\Laravel\Routes\Exceptions\RouteFileNotFoundException;
use Tohuma\Laravel\Routes\Exceptions\NamespacesInvalidException;

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
        $namespaces = config('routes');
        if( is_null($namespaces) ) {
            throw new RouteFileNotFoundException('config/routes.php');
        }

        if( !is_array($namespaces) ) {
            throw new NamespacesInvalidException('Namespace list is invalid.');
        }


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
        foreach( $namespaces as $key => $namespace ) {
            $groupname = substr( $namespace, strrpos($namespace, '\\') + 1, strlen($namespace) );
            $name = strtolower( $groupname );

            $router->group(['prefix' => $name, 'namespace' => $namespace], function ($router) use ($groupname) {

                require app_path("Http/Controllers/{$groupname}/routes.php");
            });
        }
    }
}
