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
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('client')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api-client.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            // Admin Routes
            Route::prefix('admin')
                ->middleware(['web', 'auth', 'admin'])
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            // User Protected Routes
            Route::prefix('user') // Base User Routes
                ->middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/user/user.php'));

                Route::prefix('user/services') // User Service Routes
                ->middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(function() {
                    Route::prefix('/minecraft')->middleware('service:mc-java')->group(base_path('routes/user/service/minecraft.php')); // Minecraft
                    Route::prefix('/authkey')->middleware('service:authme')->group(base_path('routes/user/service/authkey.php')); // AuthKey
                });

            // Auth Protected Routes
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
