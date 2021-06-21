<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// On utilise la facade View et on va chercher le modele category
use Illuminate\Support\Facades\View;
use App\Models\Category;

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

        // COMPOSEUR DE VUE :
        /* On utilise la façade View avec la méthode composer pour mettre en place
        ** le fait que chaque fois qu’une des deux vues index ou create est appelée,
        ** on associe la variable categories qui contient toutes les catégories. */
        View::composer(['index', 'create'], function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
