<?php

namespace App\Helpers;
use App\Models\Recipe;

class RecipeHelper
{
  public static function generateShareMessage(Recipe $recipe): string
  {
    return  <<<TEXT
  Receita: {$recipe->title}

  Ocasião: {$recipe->occasion}
  Nível de habilidade: {$recipe->skill}
  Serve: {$recipe->people} pessoas
  Ingredientes: {$recipe->ingredients}

  Modo de preparo:
  {$recipe->content}

  Compartilhado via ReceitAI
  TEXT;
  }

}