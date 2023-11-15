<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // money blade function
        Blade::directive('money', function ($amount) {
            $naira = "₦";
            return "<?php echo '$naira'.number_format($amount); ?>";
        });

        if(env('APP_ENV') != 'local'){
            URL::forceScheme('https');
        }

    }
}
