<?php

use App\Models\Trans\Recipe;
use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recipe::class, 20)->create();
    }
}
