<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';
    protected $CONTROLLERS = 'App\Http\Controllers';
    protected $CONTROLLERS_CATALOGS = 'App\Http\Controllers\Catalogs';
    protected $CONTROLLERS_OPERATION = 'App\Http\Controllers\Operation';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')->namespace($this->CONTROLLERS)
                ->group(base_path('routes/web.php'));
            //Admin
            Route::middleware(['web', 'auth:sanctum', config('jetstream.auth_session'), 'verified',])
                ->namespace($this->CONTROLLERS)
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
            // Catalogs
            Route::middleware(['web', 'auth:sanctum', config('jetstream.auth_session'), 'verified',])
                ->namespace($this->CONTROLLERS_CATALOGS)
                ->prefix('catalogs')
                ->group(base_path('routes/catalogs.php'));
            // Operation
            Route::middleware(['web', 'auth:sanctum', config('jetstream.auth_session'), 'verified',])
                ->namespace($this->CONTROLLERS_OPERATION)
                ->prefix('operation')
                ->group(base_path('routes/operation.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
