<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Helpers\PromptHelper;
use Illuminate\Support\Facades\Redis;

class PromptService
{
    /**
     * Create a new class instance.
     */
    public function getSessionData(): array
    {
        return [
            'occasion' => session('prompt.occasion'),
            'type' => session('prompt.type'),
            'skill' => session('prompt.skill'),
            'people' => session('prompt.people'),
            'ingredients' => session('prompt.ingredients'),
            'recipe' => session('prompt.recipe')
        ];
    }

    public function processPrompt(Request $request): array
    {
        $validation = $this->validateInput($request);
        if ($validation !==true) {
            return $validation;
        }

        $peopleValidation = $this->validatePeople($request->input('people'));
        if ($peopleValidation !== true) {
            return $peopleValidation;
        }
        
        $occasion = $request->input('occasion');
        $type = $request->input('type');
        $skill = $request->input('skill');
        $people = $request->input('people');
        $ingredients = PromptHelper::sanitizeText($request->input('ingredients'));

        $recipe = "Receita fictícia para $people pessoas com $ingredients, ideal para $occasion. Nível de habilidade: $skill.";

        session([
            'prompt.occasion' => $occasion,
            'prompt.skill' => $skill,
            'prompt.ingredients' => $ingredients,
            'prompt.type' => $type,
            'prompt.people' => $people,
            'prompt.recipe' => $recipe,
        ]);
    
        return([
            'prompt.occasion' => $occasion,
            'prompt.skill' => $skill,
            'prompt.ingredients' => $ingredients,
            'prompt.type' => $type,
            'prompt.people' => $people,
            'prompt.recipe' => $recipe,
        ]);
    }

        private function validateInput(Request $request): true|array
    {
        $fields = ['occasion', 'type', 'skill', 'people', 'ingredients'];
        foreach ($fields as $field) {
            $value = $request->input($field);
            if (is_null($value) || $value === '') {
                return ['error' => "O campo '$field' é obrigatório."];
            }
        }
        return true;
    }

    private function validatePeople ($people): true|array
    {
        return (is_numeric($people) && $people > 0 && $people < 100)
            ? true
            :['error' => "O número de pessoas deve  estar entre 1 e 99"];
    }



    public function clearSessionData (): void
    {
        session::forget('prompt');
    }
}
