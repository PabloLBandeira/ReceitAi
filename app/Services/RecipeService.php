<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;


class RecipeService
{
  public function saveFromSession(): Recipe
    {
        $data = Session::get('prompt');

        $recipe = new Recipe();
        $recipe->user_id = Auth::id(); // ou null, se receita anônima
        $recipe->occasion = $data['occasion'] ?? '';
        $recipe->type = $data['type'] ?? '';
        $recipe->skill = $data['skill'] ?? '';
        $recipe->people = $data['people'] ?? 1;
        $recipe->ingredients = $data['ingredients'] ?? '';
        $recipe->content = $data['recipe'] ?? '';

        $recipe->save();

        return $recipe;
    }

  public function updateRecipe(Recipe $recipe, array $data): Recipe
  {
      $recipe->update([
          'occasion' => $data['occasion'] ?? $recipe->occasion,
          'type' => $data['type'] ?? $recipe->type,
          'skill' => $data['skill'] ?? $recipe->skill,
          'people' => $data['people'] ?? $recipe->people,
          'ingredients' => $data['ingredients'] ?? $recipe->ingredients,
          'content' => $data['content'] ?? $recipe->content,
      ]);

      return $recipe;
  }

      public function deleteRecipe(Recipe $recipe): bool
    {
        return $recipe->delete();
    }
}
