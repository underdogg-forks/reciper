<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CancelMessageRequest;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class ApprovesController extends Controller
{

    /**
     * Shows all recipes that need to be approved
     * by administration
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unapproved_waiting = Recipe::oldest()
            ->where(lang() . '_approver_id', 0)
            ->approved(0)
            ->ready(1)
            ->paginate(30)
            ->onEachSide(1);

        $unapproved_checking = Recipe::oldest()
            ->where(lang() . '_approver_id', '!=', 0)
            ->approved(0)
            ->ready(1)
            ->paginate(30)
            ->onEachSide(1);

        // Check if admin is already has recipe that he didnt approved
        $already_checking = Recipe::where(lang() . '_approver_id', user()->id)->approved(0)->ready(1)->value('id');

        if ($already_checking) {
            return redirect("/admin/approves/$already_checking")->withSuccess(
                trans('approves.finish_checking')
            );
        }

        return view('admin.approves.index', compact(
            'unapproved_waiting', 'unapproved_checking'
        ));
    }

    /**
     * @param Recipe $recipe
     */
    public function show(Recipe $recipe)
    {
        // Check if u can work with the recipe
        if (($error = $this->hasErrors($recipe)) !== false) {
            return redirect("/admin/approves")->withError($error);
        }

        if (!optional($recipe->approver)->id) {
            $recipe->update([lang() . '_approver_id' => user()->id]);
        }

        return view('admin.approves.show', compact('recipe'));
    }

    /**
     * @param Recipe $recipe
     */
    public function ok(Recipe $recipe, Request $request)
    {
        // Check if u can work with the recipe
        if (($error = $this->hasErrors($recipe)) !== false) {
            return redirect("/admin/approves")->withError($error);
        }

        cache()->forget('all_unapproved');
        cache()->forget('search_suggest');
        event(new \App\Events\RecipeGotApproved($recipe, trans('approves.approved_' . rand(1, 5))));

        $recipe->increment('approved_' . lang());

        return redirect('/recipes')->withSuccess(
            trans('recipes.recipe_published')
        );
    }

    /**
     * @param Recipe $recipe
     * @param CancelMessageRequest $request
     */
    public function cancel(Recipe $recipe, CancelMessageRequest $request)
    {
        // Check if u can work with the recipe
        if (($error = $this->hasErrors($recipe)) !== false) {
            return redirect("/admin/approves")->withError($error);
        }

        cache()->forget('all_unapproved');
        cache()->forget('search_suggest');

        event(new \App\Events\RecipeGotCanceled($recipe, $request->message));

        $recipe->decrement('ready_' . lang());

        return redirect('/recipes')->withSuccess(
            trans('recipes.you_gave_recipe_back_on_editing')
        );
    }

    /**
     * Checks if recipe not approved and ready
     * @param $recipe
     */
    public function hasErrors($recipe)
    {
        if ($recipe->isDone()) {
            return trans('approves.already_approved');
        }

        if (!$recipe->isReady() && !$recipe->isApproved()) {
            return trans('recipes.not_written');
        }
        return false;
    }
}
