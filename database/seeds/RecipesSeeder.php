<?php

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(Recipe::class, 16)->create();
        $this->first();
        $this->second();
        $this->third();
        $this->forth();
	}
	

	public function first()
	{
		return Recipe::create([
			'user_id' => 2,
			'meal_id' => 1,
			'time' => 90,
			'image' => '1520801530235151229.jpg',
			'created_at' => '2018-03-11 22:52:10',
			'updated_at' => '2018-05-17 10:01:39',

			'ready_ru' => 1,
			'approved_ru' => 1,
			// Title
			'title_ru' => 'Сливовый пирог со сливами из песочного теста',
			// Intro
			'intro_ru' => 'Всем любителям кисло-сладкой домашней еды предлагаю приготовить сливовый пирог. Замечательный вкус, простой кулинарный рецепт - не пожалеете!',
			// Ingredients
			'ingredients_ru' => 'Сливы - по вкусу
			Мука - 3 ст. ложка
			Яйца - 2 шт
			Сахар - 50 гр
			Сливочное масло - 200 гр
			Сахар - 4 ст. ложки
			Мука - 250 гр
			Яйца - 1 шт
			Разрыхлитель - 1 ч. ложка
			Ванилин - 2 гр',
			// Text
			'text_ru' => 'Муку просеиваем, смешиваем с разрыхлителем,
			Добавляем яйцо, сахар, 1 пакетик ванилина, 125 грамм мелко нарезанного сливочного масла (или растопленного на слабом огне) и замешиваем тесто. Отправляем его в холодильник на полчасика.
			Оставшееся сливочное масло взбиваем с сахаром, яйцами, добавляем муку и второй пакетик ванилина. Хорошенько вымешиваем. 
			Сливы разрезаем пополам, удаляя косточки. 
			Каждую половинку надрезаем вдоль до середины. 
			Берем форму, смазываем маслом. 
			Тесто выкладываем на дно формы и делаем бортик высотой примерно 3 сантиметра. 
			Сверху выкладываем начинку и разравниваем. 
			В начинку втыкаем сливы так, чтобы надрезанная часть была сверху. 
			Ставим форму в духовку на 40-45 минут при температуре 180 градусов.
			Готовый пирог остужать надо в форме, так как из-за слив он будет очень сочный и может развалиться (я держала в форме 2 часа, этого вполне хватило). 
			Сверху посыпьте пирог миндальной крошкой.',
		]);
	}

	public function second()
	{
		return Recipe::create([
			'user_id' => 2,
			'meal_id' => 2,
			'time' => 30,
			'image' => '15209481361341856761.jpg',
			'created_at' => '2018-03-13 15:35:36',
			'updated_at' => '2018-06-02 20:55:20',

			'ready_ru' => 1,
			'approved_ru' => 1,
			// Title
			'title_ru' => 'Гречаники с грибами',
			// Intro
			'intro_ru' => 'Гречаники – это отличные котлеты из грибов и гречки.',
			// Ingredients
			'ingredients_ru' => 'Гречка (сухая) – 100 гр.
			Вода – 250 мл.
			Соль
			Перец
			Шампиньоны свежие (или другие грибы) – 200 гр.
			Лук репчатый – 1 шт.
			Зелень – пучок
			Мука – 1/2 стакана
			Растительное масло',
			// Text
			'text_ru' => 'Сначала варим гречку.  До кипения гречку доводим на сильном огне, убавляем огонь и варим, пока вода не испарится. Варим гречку с закрытой крышкой. 
			Режем лук, жарим его до золотистого цвета на растительном масле. Чистим и режем мелко грибы, отправляем их на сковородку к луку. Грибы жарятся минут 5-7. За пару минут до готовности солим, перчим. Готовые грибы перекладываем в тарелку, чтобы они остыли.
			Режем зелень. Если грибы порезаны крупно, можно положить их в блендер с зеленью, перемалываем. Конечно, можно измельчить грибы в мясорубке. 
			Смешиваем гречку с грибами. Вымесить нужно хорошо, до однородной массы, чтобы она хорошо лепилась.
			Лепим из массы круглые котлеты, обваливаем каждую в муке.
			На разогретую сковородку наливаем немного рафинированного масла. На сильном огне жарим гречаники минуты по три с каждой стороны, чтобы получилась корочка.',
		]);
	}


	public function third()
	{
		return Recipe::create([
			'user_id' => 1,
			'meal_id' => 1,
			'time' => 10,
			'image' => '1522662505507359578.jpg',
			'created_at' => '2018-04-02 12:48:26',
			'updated_at' => '2018-05-22 14:09:06',

			'ready_ru' => 1,
			'approved_ru' => 1,
			// Title
			'title_ru' => 'Морковь по-корейски',
			// Intro
			'intro_ru' => 'Вкусная морковь по-корейски за 10 минут которая готовится довольно просто. Морковь приправленная пряностями, будет отличной закуской на вашем столе. Лучше всего выбирать свежую и сладкую морковь для приготовления. Если у вас нет шинковки можно морковь нарезать тонкими ломтиками.',
			// Ingredients
			'ingredients_ru' => '1 кг моркови
			1 маленькая луковица
			1 зубчик чеснока
			1/2 ч. л. красного перца
			1 ч. л. соли
			1 ч. л. молотого кориандра
			1/2 ч. л. сахара
			1/2 ч. л. черного перца
			3 капли уксуса',
			// Text
			'text_ru' => 'После того как морковь почищена, натираем ее на терке (шинковка).
			В натертую морковь добавляем 1 чайную ложку соли, пол чайной ложки сахара и 3 капли уксуса.
			Мелко нарезанный лук обжариваем на растительном масле до мягкости.
			Добавляем пол ложки красного перца в обжаренный лук.
			Перед тем как добавить лук в наш салат, мы добавляем 1 зубчик чеснока, пол чайной ложки черного перца и ложку молотого кориандра в нашу морковь.
			Теперь можно добавить лук с красным перцем и хорошо перемешать.
			Оставить в холодильнике на пару часов чтобы морковь хорошо промариновалась.',
		]);
	}


	public function forth()
	{
		return Recipe::create([
			'user_id' => 2,
			'meal_id' => 2,
			'time' => 60,
			'image' => '15231914931090662540.jpg',
			'created_at' => '2018-04-08 15:44:54',
			'updated_at' => '2018-05-31 13:03:08',

			'ready_ru' => 1,
			'approved_ru' => 1,
			// Title
			'title_ru' => 'Пасхальный кулич с цукатами',
			// Intro
			'intro_ru' => 'Пасхальный кулич с цукатами, готовится в двух вариантах. Очень простой рецепт и очень вкусный результат. Можно делать тесто с изюмом, можно вообще без добавок.',
			// Ingredients
			'ingredients_ru' => 'Дрожжи свежие - 50 г (или 25 г для медленного подъёма теста в холодильнике).
			Мука - 700-1000 г
			Молоко - 350 мл
			Масло сливочное - 300 г
			Масло растительное - 100 мл
			Яйца - 5 шт +1 желток
			Сахар - 1,5 - 2 стакана
			Ванильный сахар - 1 ст.л.
			Ванилин - 1 пач.(10 г)
			Соль - 1 ч.л.
			Цукаты - 150 г
			Белок - 1
			Сахарная пудра - 200-250 г
			Сок лимона - 1 ст.л.',
			// Text
			'text_ru' => 'Цукаты порезать небольшими кубиками.
			Муку просеять 2-3 раза
			Сливочное масло на 1-2 часа подержать при комнатной температуре
			5 яиц отделить белки от желтков
			Миску с белками накрыть плёнкой и отставить
			А в миску с желтками всыпать соль, сахар, ванильный сахар, ванилин и растереть в блендере или вилкой (если густо, добавить 1 ст. л. воды).
			В миску налить 50 мл тёплого молока, добавить 1 ст.л. сахара и перемешать
			Расскрошить в молоко дрожжи и перемешать.
			Поставить в тёплое место на 10 - 20 минут
			ОПАРА. В большую миску насыпать 150 г муки, добавить 300 мл тёплого молока - перемешать
			Вспенившиеся дрожжи размешать вилкой и влить в молочную смесь, перемешать 
			Поставить в тёплое место на 40-60 минут (за это время опара должна подняться, сморщиться и начать опадать)
			Как только опала - готова.
			В опару добавить желтки с сахаром и перемешать.
			Взбить белки миксером (или венчиком) в кустую пену, добавить в тесто и перемешать.
			Небольшими порциями добавляем муку, замешиваем тесто сначала в миске, потом на столе (переодически смазывая руки и тесто растительным маслом)
			Продолжая вымешивать тесто добавляем в него кусочки сливочного масла и вмешиваем его в тесто.
			Вымешивать тесто желательно долго (до 1 часа)
			Выложить тесто в большую ёмкость, накрыть крышкой или затянуть плёнкой и поставить в тёплое место на 3-5 часов.
			Тесто подошло и него нужно обмять, опустив в него руку.
			Если тесто ставить в холодильник (25 г дрожжей).
			С малым колличеством дрожжей и длительным временем подъёма теста в холодильнике куличи получаются вкуснее и без запаха дрожжей.
			Подошедшее тесто обмять, помесить, согреть. добавить цукаты (или изюм) вымешать.
			Формы смазать тонким слоем растительного масла, бока обсыпать мукой или манкой.
			На дно пергамент.
			Тесто выкладывать на 1/3 - 1/2 формы и оставить в тёплом месте на 1 - 1,5 часа.
			Для смазывания куличей: желток+1 ст.л. воды - взболтать.
			Духовку разогреть заранее до 180 градусов
			Выпекать 30-60 минут.
			Первые 15-20 минут духовку не открывать, иначе куличи могут опасть.
			Проверять говность деревянной палочкой. Хранить в плёнке.',
		]);
	}
}
