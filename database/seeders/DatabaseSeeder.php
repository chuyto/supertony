<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;


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

        // Crear usuarios y asignarles roles

        // Usuario Administrador
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole('administrador');

        // Usuario Gerente
        $gerenteUser = User::create([
            'name' => 'Gerente User',
            'email' => 'gerente@example.com',
            'password' => bcrypt('password'),
        ]);
        $gerenteUser->assignRole('gerente');

        // Usuario Cajero
        $cajeroUser = User::create([
            'name' => 'Cajero User',
            'email' => 'cajero@example.com',
            'password' => bcrypt('password'),
        ]);
        $cajeroUser->assignRole('cajero');
    }
}
