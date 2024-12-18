<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Aspian',
            'email' => 'aspian@ganteng.id',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Kuro',
            'email' => 'kuro@mail.id'
        ]);

        User::factory()->create([
            'name' => 'Shiro',
            'email' => 'shiro@mail.id'
        ]);

        User::factory()->count(7)->create();
    }
}
