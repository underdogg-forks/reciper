<?php

namespace Tests\Browser\Views\Recipes;

use App\Models\Recipe;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RecipesEditPageTest extends DuskTestCase
{
    /** @test */
    public function user_can_edit_his_own_recipe(): void
    {
        $this->artisan('wipe');

        $this->browse(function (Browser $browser) {
            $user = create(User::class);
            $recipe = create(Recipe::class, [
                'user_id' => $user->id,
            ]);

            $browser->loginAs($user)
                ->visit("/recipes/$recipe->id")
                ->click('#popup-window-trigger')
                ->waitFor('#_to_drafts')
                ->click('#_to_drafts')
                ->assertPathIs("/recipes/$recipe->id/edit")
                ->waitFor('#publish-btn')
                ->click('#publish-btn')
                ->assertDialogOpened(trans('recipes.are_you_sure_to_publish'))
                ->acceptDialog()
                ->assertPathIs('/users/other/my-recipes')
                ->logout();
        });
    }

    /** @test */
    public function user_cant_edit_other_recipes(): void
    {
        $this->browse(function (Browser $browser) {
            $user = create(User::class);

            $recipe = create(Recipe::class, [
                'user_id' => create(User::class)->id,
            ]);

            $browser
                ->loginAs($user)
                ->visit("/recipes/$recipe->id")
                ->assertDontSee('.edit-recipe-icon')
                ->visit("/recipes/$recipe->id/edit")
                ->assertPathIs('/recipes');
        });
    }
}
