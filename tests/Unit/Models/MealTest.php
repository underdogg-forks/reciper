<?php

namespace Tests\Unit\Models;

use App\Models\Meal;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MealTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @return void
     */
    public function model_has_attributes(): void
    {
        $attributes = ['table', 'guarded', 'timestamps'];

        array_map(function ($attr) {
            $this->assertClassHasAttribute($attr, Meal::class);
        }, $attributes);
    }

    /**
     * @test
     * @return void
     */
    public function model_has_relationship_with_recipes(): void
    {
        $meal = Meal::find(1);
        $recipe = create(Recipe::class, [
            'meal_id' => 1,
        ], 2);

        $this->assertTrue($meal->recipes()->exists());
        $this->assertGreaterThanOrEqual(2, $meal->recipes->count());
    }

    /**
     * @test
     * @return void
     */
    public function method_get_name_returns_name(): void
    {
        $actual = Meal::get(['name_' . lang()]);
        $expected = [
            trans('header.breakfast'),
            trans('header.lunch'),
            trans('header.dinner'),
        ];

        foreach ($actual as $i => $meal) {
            $this->assertEquals($meal->getName(), $expected[$i]);
        }
    }
}