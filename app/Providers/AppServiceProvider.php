<?php

namespace App\Providers;

use DB;
use Schema;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Title;
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
			logger()->emergency(trans('logs.no_table', ['table' => 'recipes']));
		}
	}


	public function showListOfCategories()
	{
		if (Schema::hasTable('recipes')) {
			$all_categories = Recipe
				::with('categories')
				->first()
				->categories
				->toArray();
				
			$category_names = array_map(function($item) {
				return $item['name_'.locale()];
			}, $all_categories);
				
			view()->share(compact('category_names'));
		} else {
			logger()->emergency(trans('logs.no_table', ['table' => 'recipes']));
		}
	}
}
