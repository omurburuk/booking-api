<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport; // add this

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */

   /**
    * Register any authentication / authorization services.
    *
    * @return void
    */
   public function boot()
   {
       //Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
       //Passport::routes(); // Add this
   }
}
