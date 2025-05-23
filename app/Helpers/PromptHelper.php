<?php

namespace App\Helpers;

class PromptHelper
{
    /**
     * Create a new class instance.
     */
    protected static array $blacklist = [
    'sabão', 'cloro', 'veneno', 'remédio', 'ácido', 'detergente', 
    'álcool', 'perfume', 'cigarro', 'tinta', 'cola', 'limpeza'
    ];

    public static function sanitizeText(string $text): string
    {

        $text = trim($text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = preg_replace('/,{2,}/', ',', $text);
        $text = preg_replace('/\s*,\s*/', ', ', $text);
        $text = preg_replace('/[^a-zA-Z0-9À-ÿ, ]/u', '', $text);
        $text = str_replace(["\r\n", "\r", "\n"], ', ', $text);

        $ingredientsArray = array_map('trim', explode(',', $text));

        $filteredIngredients = array_filter($ingredientsArray, function($item) {
            return !in_array(mb_strtolower($item), self::$blacklist);
        });

        return implode(', ', $filteredIngredients);
    }
}
