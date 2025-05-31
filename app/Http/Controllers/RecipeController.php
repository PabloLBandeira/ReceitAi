<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecipeService;
use App\Models\Recipe;
use App\Helpers\RecipeHelper;
use Illuminate\Support\Facades\Log;


class RecipeController extends Controller
{
    protected RecipeService $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function index()
    {
        return view('perfil');
    }

    public function store(Request $request)
    {
        if(!session()->has('prompt')) {
            return response()->json([
                'message' => 'Os dados da receita não foram encontrados'
            ], 400);
        }

        try {
            $recipe = $this->recipeService->saveFromSession($request->user());

            return response()->json([
                'data' => $recipe,
                'message' => 'Receita salva com sucesso!'
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error("Database error saving recipe: " . $e->getMessage());
            return response()->json([
                'message' => 'Erro ao persistir receita no banco de dados'
            ], 500);
        } catch (\Exception $e) {
        Log::error("Error saving recipe: " . $e->getMessage());
        return response()->json([
            'message' => 'Erro inesperado ao salvar receita'
        ], 500);
        }
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
