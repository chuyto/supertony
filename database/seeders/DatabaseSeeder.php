<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);


        // Crear usuario vendedor y asignarle el rol de vendedor
        $vendedorUser = User::create([
            'name' => 'Vendedor User',
            'email' => 'vendedor@example.com',
            'password' => bcrypt('password'),
        ]);
        $vendedorUser->assignRole('vendedor');
    }
}
