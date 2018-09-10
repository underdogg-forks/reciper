<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Title;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $random_recipes = Recipe::inRandomOrder()
            ->where("ready_" . lang(), 1)
            ->where("approved_" . lang(), 1)
            ->limit(12)
            ->get([
                'id', 'title_' . lang(),
                "intro_" . lang(), 'image',
            ]);

        $title_intro = cache()->rememberForever('title_intro', function () {
            return Title::whereName("intro")->first([
                'title_' . lang(),
                'text_' . lang(),
            ]);
        });

        return view('pages.home', compact('random_recipes', 'title_intro'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        if (request('for')) {
            $request = mb_strtolower(request('for'));

            // If no recipes found, search for recipe title or intro
            $recipes = Recipe::where('title_' . lang(), 'LIKE', "%$request%")
                ->orWhere('ingredients_' . lang(), 'LIKE', "%$request%")
                ->take(50)
                ->done(1)
                ->get();

            $message = count($recipes) > 0 ? '' : trans('pages.nothing_found');
        } else {
            $message = trans('pages.use_search');
        }

        return view('pages.search', compact('recipes', 'message'));
    }
}
