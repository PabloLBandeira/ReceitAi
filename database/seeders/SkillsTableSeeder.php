<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('skills')->insert([
            ['name' => 'Fervedor de água', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Desbravador de Panelas', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Aventureiro do Fogão', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chef honorário', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
