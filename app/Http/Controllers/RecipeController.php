<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecipeService;
use App\Models\Recipe;
use App\Helpers\RecipeHelper;


class RecipeController extends Controller
{
    protected RecipeService $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function store(Request $request)
    {
        $result = $this->recipeService->saveFromSession($request->user());
        return response()->json($result, 201);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->only(['title', 'ingredients', 'steps', 'type', 'occasion', 'people']);
        $result = $this->recipeService->updateRecipe($recipe, $data);
        return response()->json($result);
    }

    public function destroy(Recipe $recipe)
    {
        $this->recipeService->deleteRecipe($recipe);
        return response()->json(['message' =>'Receita excluída com sucesso.']);
    }

    public function share(Recipe $recipe)
{
    $message = RecipeHelper::generateShareMessage($recipe);
    return response()->json(['message' => $message]);
}
    
}
