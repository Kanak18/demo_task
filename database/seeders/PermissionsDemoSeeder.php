<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit task']);
        Permission::create(['name' => 'delete task']);
        Permission::create(['name' => 'create task']);
        Permission::create(['name' => 'view task']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'customer']);
        $role1->givePermissionTo('view task');
        $role1->givePermissionTo('edit task');

        $role2 = Role::create(['name' => 'manager']);
        $role2->givePermissionTo('edit task');
        $role2->givePermissionTo('delete task');
        $role2->givePermissionTo('create task');
        $role2->givePermissionTo('view task');

        $role3 = Role::create(['name' => 'admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Customer One',
            'email' => 'cust_one@gmail.com',
            'password' => '$2y$10$rc2sA9As9/aRpk3Bks8yM.fQIzA7FRCNmxzA5Lh2aIJBEmy2fu5oC',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Manager One',
            'email' => 'manager_one@gmail.com',
            'password' => '$2y$10$rc2sA9As9/aRpk3Bks8yM.fQIzA7FRCNmxzA5Lh2aIJBEmy2fu5oC',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$rc2sA9As9/aRpk3Bks8yM.fQIzA7FRCNmxzA5Lh2aIJBEmy2fu5oC',
        ]);
        $user->assignRole($role3);
    }
}
