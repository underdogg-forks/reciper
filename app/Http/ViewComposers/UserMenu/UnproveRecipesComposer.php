<?php

namespace App\Http\ViewComposers\UserMenu;

use App\Models\Recipe;
use Illuminate\View\View;

class UnproveRecipesComposer
{
    /**
     * Bind data to the view
     * @param  View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        if (user()->isAdmin()) {
            $view->with('all_unapproved', Recipe::query()->approved(0)->ready(1)->count());
        }
    }
}
