<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $admin = Role::create(['name' => 'administrador']);
        $gerente = Role::create(['name' => 'gerente']);
        $cajero = Role::create(['name' => 'cajero']);

        // Crear permisos
        $fullAccess = Permission::create(['name' => 'full access']);
        $manageSettings = Permission::create(['name' => 'manage settings']);
        $accessPos = Permission::create(['name' => 'access pos']);

        // Asignar permisos a roles
        $admin->givePermissionTo([$fullAccess, $manageSettings, $accessPos]);
        $gerente->givePermissionTo([$fullAccess, $accessPos]); // No tiene el permiso para manage settings
        $cajero->givePermissionTo($accessPos); // Solo tiene acceso al módulo de Pos
    }
}
