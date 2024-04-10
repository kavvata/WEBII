<?php

namespace App\Providers;

use App\View\Components\Button;
use App\View\Components\Datatable;
use App\View\Components\Navbar;
use App\View\Components\TextBox;
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
        Blade::component('navbar', Navbar::class);
        Blade::component('datatable', Datatable::class);
        Blade::component('textbox', TextBox::class);
        Blade::component('button', Button::class);
    }
}
