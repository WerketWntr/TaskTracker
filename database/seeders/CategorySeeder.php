<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Category::insert([
            ['name' => 'Work', 'user_id' => $user->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Personal', 'user_id' => $user->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Urgent', 'user_id' => $user->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
