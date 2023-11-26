<?php declare(strict_types=1);

namespace Antwerpes\FilamentNestedSetOrder;

use Illuminate\Support\ServiceProvider;

class FilamentNestedSetOrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/filament-nested-set-order.php' => config_path('filament-nested-set-order.php'),
        ]);
    }
}
