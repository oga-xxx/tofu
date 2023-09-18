<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();

        Log::error("index");

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('recipes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe = new Recipe();
        $recipe->name = $request->input('name');
        $recipe->image = $request->input('image');
        $recipe->cooking = $request->input('cooking');
        $recipe->score = $request->input('score');
        $recipe->category_id = $request->input('category_id');
        $recipe->save();

        return to_route('recipes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $recipe->name = $request->input('name');
        $recipe->image = $request->input('image');
        $recipe->cooking = $request->input('cooking');
        $recipe->score = $request->input('score');
        $recipe->category_id = $request->input('category_id');
        $recipe->update();

        return to_route('recipes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return to_route('recipes.index');
    }

    public function search(Request $request)
    {
        
        $categories = Category::all();
        $recipes = Recipe::all();
        
        $query = Recipe::query();

        $search1 = $request->input('name');
        $search2 = $request->input('category_id');
        $search3 = $request->input('score');
    

        if ($search1!=null) {
            $query->where('name', 'like', '%'.$search1.'%')->get();
        }

        if ($search2!=null) {
            $query->where('category_id', $search2)->get();
        }

        if ($search3!=null) {
            $query->where('score', $search3)->get();
        }

        $data = $query->paginate(5);
        
        return view('recipes.search', compact('recipes', 'categories'),[
            'data' => $data
        ]);
    }

    public function favorite(Recipe $recipe)
    {
        Auth::user()->togglefavorite($recipe);

        return back();
    }
}
