<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::insert([
			[ 'category' => 'Вторые блюда' ],
			[ 'category' => 'Выпечка' ],
			[ 'category' => 'Гарниры' ],
			[ 'category' => 'Десерты' ],
			[ 'category' => 'Детские блюда' ],
			[ 'category' => 'Завтраки' ],
			[ 'category' => 'Крупы' ],
			[ 'category' => 'Мультиварка' ],
			[ 'category' => 'Мясо' ],
			[ 'category' => 'Овощи' ],
			[ 'category' => 'Рыба' ],
			[ 'category' => 'Салаты' ],
			[ 'category' => 'Соусы' ],
			[ 'category' => 'Суши' ],
			[ 'category' => 'Разное' ]
		]);
    }
}