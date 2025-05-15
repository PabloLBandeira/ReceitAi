<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('1234'),
                'role' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Moderator User',
                'email' => 'moderator@example.com',
                'password' => bcrypt('1234'),
                'role' => 'moderator',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Regular User 1',
                'email' => 'user1@example.com',
                'password' => bcrypt('1234'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Regular User 2',
                'email' => 'user2@example.com',
                'password' => bcrypt('1234'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
