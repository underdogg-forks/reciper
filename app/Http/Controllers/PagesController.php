<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\View;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $visited = View::whereVisitorId(visitor_id())->pluck('recipe_id');
        $random_recipes = $this->getRandomRecipes($visited);

        // If not enough recipes to display, show just random recipes
        if ($random_recipes->count() < 12) {
            $random_recipes = $this->getRandomRecipes();
        }

        $last_liked = Recipe::query()->join('likes', 'likes.recipe_id', '=', 'recipes.id')
            ->orderBy('likes.id', 'desc')
            ->limit(8)
            ->done(1)
            ->get(['recipe_id', 'image', 'intro_' . lang(), 'title_' . lang()]);

        return view('pages.home', compact('random_recipes', 'last_liked'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $recipes = collect();
        $message = trans('pages.use_search');

        if (request('for')) {
            $request = mb_strtolower(request('for'));

            $recipes = Recipe::where('title_' . lang(), 'LIKE', "%$request%")
                ->orWhere('ingredients_' . lang(), 'LIKE', "%$request%")
                ->take(50)
                ->done(1)
                ->paginate(12);

            $message = $recipes->count() == 0 ? trans('pages.nothing_found') : '';
        }

        $search_suggest = cache()->remember('search_suggest', config('cache.search_suggest'), function () {
            return Recipe::query()->done(1)->pluck('title_' . lang())->toArray();
        });

        return view('pages.search', compact(
            'recipes', 'search_suggest', 'message'
        ));
    }

    /**
     * @param object|null $except
     */
    public function getRandomRecipes(?object $except = null)
    {
        $query = Recipe::inRandomOrder();

        if ($except) {
            $query->where($except->map(function ($id) {
                return ['id', '!=', $id];
            })->toArray());
        }
        return $query->done(1)->limit(12)->get(['id', 'image', 'title_' . lang(), 'intro_' . lang()]);
    }
}
