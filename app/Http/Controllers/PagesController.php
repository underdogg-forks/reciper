<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Recipe;

class PagesController extends Controller
{
	// HOME
    public function home() {
        $title = "Рецепты";
        return view('pages.home')->with('title', $title);
	}

	// SEARCH
	public function search(Request $request)
    {
		$query = $request->input('search_for');

		if ($query) {
			$recipes = Recipe::where('title', 'LIKE', '%' . $query . '%')
					->orWhere('ingredients', 'LIKE', '%' . $query . '%')
					->orWhere('category', 'LIKE', '%' . $query . '%')
					->paginate(20);
		} else {
			$recipes = '';
		}

		return view('pages.search')
					->withRecipes($recipes);
	}
}
