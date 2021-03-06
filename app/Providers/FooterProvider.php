<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FooterProvider extends ServiceProvider
{
    /**
     * Bootstrap services
     * @return void
     */
    public function boot(): void
    {
        $this->composerRandomRecipes();
        $this->composerPopularRecipes();
        $this->composerDocuments();
    }

    /**
     * @return void
     */
    public function composerRandomRecipes(): void
    {
        view()->composer('includes.footer',
            \App\Http\ViewComposers\Footer\RandomRecipesComposer::class);
    }

    /**
     * @return void
     */
    public function composerPopularRecipes(): void
    {
        view()->composer('includes.footer',
            \App\Http\ViewComposers\Footer\PopularRecipesComposer::class);
    }

    /**
     * @return void
     */
    public function composerDocuments(): void
    {
        view()->composer('includes.footer',
            \App\Http\ViewComposers\Footer\DocumentsComposer::class);
    }
}
