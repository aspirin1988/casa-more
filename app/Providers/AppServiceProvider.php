<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        $this->bootBladeExtension();
    }

    private function bootBladeExtension()
    {
        /**
         * Mobile detect
         */

        Blade::directive('mobile', function () {
            return "<?php if(Agent::isMobile()) { ?>";
        });
        Blade::directive('elsemobile', function () {
            return "<?php } else { ?>";
        });
        Blade::directive('endmobile', function () {
            return "<?php } ?>";
        });
        /**
         * End Mobile detect
         */

        /**
         * Desktop detect
         */
        Blade::directive('desktop', function () {
            return "<?php if(Agent::isDesktop()) { ?>";
        });
        Blade::directive('elsedesktop', function () {
            return "<?php } else { ?>";
        });
        Blade::directive('enddesktop', function () {
            return "<?php } ?>";
        });
        /**
         * End Desktop detect
         */

        /**
         * Desktop detect
         */
        Blade::directive('tablet', function () {
            return "<?php if(Agent::isTablet()) { ?>";
        });
        Blade::directive('elsetablet', function () {
            return "<?php } else { ?>";
        });
        Blade::directive('endtablet', function () {
            return "<?php } ?>";
        });
        /**
         * End Desktop detect
         */

    }

}
