<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Recipe;

class RecipesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::where('approved', 1)
                        ->latest()
                        ->paginate(30);
        return view('recipes.index')->with('recipes', $recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // For select input
        $categories = DB::table('categories')->get();

        return view('recipes.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'название' => 'string|min:5|max:255',
            'описание' => 'string|max:2000',
            'ингридиенты' => 'string|max:5000',
            'совет' => 'string|max:5000',
            'приготовление' => 'string|max:10000',
            'время' => 'numeric|digits_between:0,1000',
            'изображение' => 'image|nullable|max:1999'
        ]);

        // Handle file uploading
        if ($request->hasFile('изображение')) {
            // Get filename
            $filenameWithExt = $request->file('изображение')->getClientOriginalName();
            // Get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get extention
            $extension = $request->file('изображение')->getClientOriginalExtension();
            $fileNameToStore = 'recipe-by-' . auth()->user()->id . '.' . $extension;
            // Upload
            $path = $request->file('изображение')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'default.jpg';
        }

        // Create Recipe in DB
        $recipe = new Recipe;
        $recipe->title = $request->input('название');
        $recipe->intro = $request->input('описание');
        $recipe->ingredients = $request->input('ингридиенты');
        $recipe->advice = $request->input('совет');
        $recipe->text = $request->input('приготовление');
        $recipe->time = $request->input('время');
        $recipe->category = $request->input('категория');
        $recipe->user_id = auth()->user()->id;
        $recipe->image = $fileNameToStore;
        $recipe->save();

        //return redirect('/recipes')->with('success', 'Рецепт успешно добавлен');
        return redirect()->back()->with('success', 'Рецепт успешно сохранен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return view('recipes.show')->with('recipe', $recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);

        // Check for correct user
        if (auth()->user()->id !== $recipe->user_id) {
            return redirect('/recipes')->with('error', 'Вы не можете редактировать не свои рецепты.');
        }

        // For select input
        $categories = DB::table('categories')->get();

        return view('recipes.edit')
                            ->with('recipe', $recipe)
                            ->with('categories', $categories);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'название' => 'string|min:5|max:255',
            'описание' => 'string|max:2000',
            'ингридиенты' => 'string|max:5000',
            'совет' => 'string|max:5000',
            'приготовление' => 'string|max:10000',
            'время' => 'numeric|digits_between:0,1000',
            'изображение' => 'image|nullable|max:1999'
        ]);

        // Handle file uploading
        if ($request->hasFile('изображение')) {
            // Get filename
            $filenameWithExt = $request->file('изображение')->getClientOriginalName();
            // Get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get extention
            $extension = $request->file('изображение')->getClientOriginalExtension();
            $fileNameToStore = 'recipe-by-' . auth()->user()->id . '.' . $extension;
            // Upload
            $path = $request->file('изображение')->storeAs('public/images', $fileNameToStore);
        }

        // Create Recipe in DB
        $recipe = Recipe::find($id);
        $recipe->title = $request->input('название');
        $recipe->intro = $request->input('описание');
        $recipe->ingredients = $request->input('ингридиенты');
        $recipe->advice = $request->input('совет');
        $recipe->text = $request->input('приготовление');
        $recipe->time = $request->input('время');
        $recipe->category = $request->input('категория');

        if ($request->hasFile('изображение')) {
            $recipe->image = $fileNameToStore;
        }
        $recipe->save();

        return redirect()->back()->with('success', 'Рецепт успешно сохранен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        // Check for correct user
        if (auth()->user()->id !== $recipe->user_id) {
            return redirect('/recipes')->with('error', 'Вы не можете редактировать не свои рецепты.');
        }

        if ($recipe->image != 'default.jpg') {
            Storage::delete('public/images/'.$recipe->image);
        }

        $recipe->delete();
        return redirect('/recipes')->with('success', 'Рецепт успешно удален');
    }
}
