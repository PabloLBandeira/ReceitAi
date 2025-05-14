<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('types')->insert([
            ['name' => 'Vegetariana', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Vegana', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Low Carb', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sem Lactose', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sem Glúten', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fitness / Saudável', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Conforto & Caseira', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rápida & Prática', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Para Impressionar', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Freestyle', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
