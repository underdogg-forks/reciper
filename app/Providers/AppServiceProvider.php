<?php

namespace App\Providers;

use DB;
use Schema;
use App\Models\User;
use App\Models\Title;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
		$this->databaseSettings();
		$this->showListOfCategories();
		$this->updateLastUserVisit();
    }


	public function databaseSettings()
	{
		Schema::defaultStringLength(191);
		// Script that shows current executed query
		// DB::listen( function ( $query ) {
		// 	dump($query->sql);
		// 	dump($query->bindings);
		// });
	}


	public function updateLastUserVisit()
	{
		if (Schema::hasTable('users')) {
			view()->composer('*', function ($view) {
				if (auth()->check()) {
					User::whereId(user()->id)->update([
						'updated_at' => NOW()
					]);
				}
			}); 
		} else {
			logger()->emergency(trans('logs.no_table', ['table' => 'recipes_' . locale()]));
		}
	}


	public function showListOfCategories()
	{
		if (Schema::hasTable('recipes_' . locale())) {
			$all_categories = Recipe::distinct()->get(['category_id']);
			$categories = [];

			foreach ($all_categories as $category) {
				array_push($categories, $category->category->toArray());
			}

			view()->share(compact('categories'));
		} else {
			logger()->emergency(trans('logs.no_table', ['table' => 'recipes_' . locale()]));
		}
	}
}
