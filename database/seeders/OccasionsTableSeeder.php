<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OccasionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('occasions')->insert([
            ['name' => 'Café da manhã', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Café da tarde', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Almoço', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lanche rápido', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jantar', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
