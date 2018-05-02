<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Title;

class PagesController extends Controller
{

	public function home()
	{
		$random_recipes = Recipe::inRandomOrder()
			->whereApproved(1)->limit(9)
			->get([ 'id', 'title', 'image' ]);

		$title_banner = Title::whereName('Баннер')
			->first([ 'title', 'text' ]);

		$title_intro = Title::whereName('Интро')
			->first([ 'title', 'text' ]);

		return view('pages.home')->with(compact(
			'random_recipes', 'title_banner', 'title_intro'
		));
	}


	public function search(Request $request)
    {
		$query = $request->input('for');
		if ($query) {
			if (is_numeric($query)) {
				$recipes = Recipe::whereCategoryId($query)
					->take(50)
					->get();
			} else {
				$recipes = Recipe::where('title', 'LIKE', '%' . $query . '%')
					->orWhere('ingredients', 'LIKE', '%' . $query . '%')
					->take(50)
					->get();
			}

			$message = count($recipes) < 1 ? trans('pages.nothing_found') : '';
		} else {
			$recipes = '';
			$message = trans('pages.use_search');
		}

		return view('pages.search')->with(compact('recipes', 'message'));
	}
}