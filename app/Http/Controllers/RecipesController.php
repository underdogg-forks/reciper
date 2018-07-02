<?php

namespace App\Http\Controllers;

use Cookie;
use App\Models\Meal;
use App\Models\Recipe;
use App\Http\Requests\RecipeSaveRequest;
use App\Http\Requests\RecipePublichRequest;
use App\Helpers\Traits\RecipesControllerHelpers;
use App\Helpers\Contracts\SaveRecipeDataContract;
use App\Http\Responses\Controllers\RecipeUpdateResponse;

class RecipesController extends Controller
{
	use RecipesControllerHelpers;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
		return view('recipes.index');
    }

    public function create()
    {
		return view('recipes.create', [
			'meal' => Meal::get(['id', 'name_' . locale()])
		]);	
    }

    /**
	 * It will save the recipe to a database
	 * @param RecipeSaveRequest $request
	 * @see RecipeSaveRequest is validating this method
	 * @see SaveRecipeDataContract
	 */
    public function store(RecipeSaveRequest $request)
    {
		$this->checkForScriptTags($request);

		$image_name = $this->saveImageIfExists($request->file('image'));
		$recipe = $this->createOrUpdateRecipe($request, $image_name);

		return redirect('/recipes/'.$recipe->id.'/edit')->withSuccess(
			trans('recipes.saved')
		);
    }

    /**
	 * It will show the recipe on a single page
	 * @param Recipe $recipe
	 */
    public function show(Recipe $recipe)
    {
        // Rules for visitors
        if (!user() && !$recipe->approved()) {
            return redirect('/recipes')->withError(trans('recipes.no_rights_to_see'));
		}

        // Rules for auth users
        if (user()) {
            if (!user()->isAdmin() && !user()->hasRecipe($recipe->user_id) && !$recipe->ready()) {
                return redirect('/recipes')->withError(trans('recipes.no_rights_to_see'));
			}

			if (!user()->hasRecipe($recipe->user_id) && !$recipe->ready()) {
                return redirect('/recipes')->withError(trans('recipes.not_written'));
			}

			if (!user()->isAdmin() && !user()->hasRecipe($recipe->user_id) && !$recipe->approved()) {
                return redirect('/recipes')->withError(trans('recipes.not_approved'));
			}
		}
		return view('recipes.show', compact('recipe'));
    }

	/**
	 * @param Recipe $recipe
	 */
    public function edit(Recipe $recipe)
    {
        // Check for correct user
        if (!user()->hasRecipe($recipe->user_id) && !user()->isAdmin()) {
            return redirect('/recipes')->withError(
				trans('recipes.no_rights_to_edit')
			);
		}

		return view('recipes.edit', [
			'recipe' => $recipe,
			'meal' => Meal::get(['id', 'name_'.locale()])
		]);
    }

    /**
	 * Update single recipe
	 * This method triggers event RecipeIsReady
	 * @see RecipePublichRequest
	 * @param RecipePublichRequest $request
	 * @param Recipe $recipe
	 * @return RecipeUpdateResponse
	 */
    public function update(RecipePublichRequest $request, Recipe $recipe)
    {
		$this->checkForScriptTags($request);

		// Handle image uploading
		$image_name = $this->saveImageIfExists($request->file('image'), $recipe->image);

		if ($request->file('image')) {
			$this->deleteOldImage($recipe->image);
		}

		$this->createOrUpdateRecipe($request, $image_name, $recipe);

        return new RecipeUpdateResponse($recipe);
    }
}
