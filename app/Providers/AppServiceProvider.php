<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('cptl', function ($expression) {
            return "<?php echo ucfirst($expression) ?>";
        });

        Blade::directive('formatNama', function ($expression) {
            return "<?php
                        \$nama = explode(' ', strtolower($expression));
                        \$nama = array_map('ucwords', \$nama);
                        
                        \$formattedNama = \$nama[0] ?? '';
                        if (isset(\$nama[1])) {
                            \$formattedNama .= ' ' . \$nama[1];
                        }
                        if (count(\$nama) > 2) {
                            for (\$i = 2; \$i < count(\$nama); \$i++) {
                                \$formattedNama .= ' ' . strtoupper(substr(\$nama[\$i], 0, 1)) . '.'; 
                            }
                        }
                    echo \$formattedNama;
                    ?>";
        });

    }
}
