<?php

namespace App\Providers;

use App\SafeSubmit\SafeSubmit;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SafeSubmitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Blade::directive('safeSubmit', function ($expression) {
            return "<?php echo '<input type=\"hidden\" name=\"' . app(SafeSubmit::class)->tokenKey() . '\" value=\"' . app(SafeSubmit::class)->token() . '\">' ?>";
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(SafeSubmit::class, function () {
            return new SafeSubmit();
        });
    }
}
