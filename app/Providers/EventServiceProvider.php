<?php

namespace App\Providers;

use Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     */
    protected $listen = [
        'App\Events\RecipeIsReady' => [
            'App\Listeners\SendSms',
        ],
        'App\Events\RecipeIsApproved' => [
            'App\Listeners\AddPointsForRecipe',
        ],
        'App\Events\RecipeGotLiked' => [
            'App\Listeners\AddPointsForLike',
        ],
        'App\Events\RecipeHasBeenSeen' => [
            'App\Listeners\AddPointsForView',
        ],
    ];
}
