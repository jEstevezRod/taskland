<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Broadcast::routes([ 'middleware' => [ 'api', 'jwt.auth' ] ] );
        // Broadcast::routes(['prefix' => 'auth', 'middleware' => [ 'jwt.auth' ]]);
        // Broadcast::routes();
        Broadcast::routes(['middleware' => ['jwt.auth']]); //if you use JWT
        // Broadcast::routes(['middleware' => ['api:jwt']]);

        require base_path('routes/channels.php');
    }
}
