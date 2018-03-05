<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Recipe;

class PagesController extends Controller
{
	// HOME
    public function home() {

		$random_recipes = Recipe::inRandomOrder()
				->where('approved', 1)
				->limit(4)
				->get();

		return view('pages.home')
				->with('random_recipes', $random_recipes);
	}

	// SEARCH
	public function search(Request $request)
    {
		$query = $request->input('for');

		if ($query) {
			$recipes = Recipe::where('title', 'LIKE', '%' . $query . '%')
					->orWhere('ingredients', 'LIKE', '%' . $query . '%')
					->orWhere('category', 'LIKE', '%' . $query . '%')
					->paginate(20);
			$message = count($recipes) < 1 ? 'Ничего не найденно' : '';
		} else {
			$recipes = '';
			$message = 'Воспользуйтесь поиском чтобы найти рецепты, ингридиенты или категории.';
		}
		return view('pages.search')
					->withRecipes($recipes)
					->withMessage($message);
	}
}
