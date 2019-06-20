<?php

namespace boopathi\firebase;

use Illuminate\Auth\Events\Logout;
use Illuminate\Session\SessionManager;
use Illuminate\Support\ServiceProvider;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('firebase', 'boopathi\firebase\Firebase');

        $config = __DIR__.'/Config/Firebase.php';
        $this->mergeConfigFrom($config, 'Firebase');

        $this->publishes([__DIR__.'/Config/Firebase.php' => config_path('Firebase.php')], 'config');

       

        
    }
}
