<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached permission and roles;
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Data Collection
        $permission = [];
        $configFiles = Config::get("permission")['roles'];
        foreach ($configFiles as $key => $value) {
            $permission = array_merge($permission, $value['permissions']);
        }

        // Creating Permissions
        $mandatory_permissions = [
            'create user', 'update user', 'delete user', 'create role', 'update role', 'delete role', 'create permission', 'update permission', 'delete permission',
        ];
        $all_permissions = array_merge($mandatory_permissions, array_unique($permission, SORT_REGULAR));
        foreach ($all_permissions as $key => $value) {
            Permission::create(['name' => $value]);
        }

        // Creating Super Admin
        $role = Role::create(['name' => 'superadmin', 'long_name' => 'Super Admin'])
            ->givePermissionTo(Permission::all());

        // Create others Roles
        foreach ($configFiles as $key => $value) {
            Role::create([
                'name' => $key,
                'long_name' => $value['long_name'],
            ])->givePermissionTo($value['permissions']);
        }
    }
}
