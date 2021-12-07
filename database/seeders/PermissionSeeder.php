<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
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
        Permission::create(['name' => 'edit presences']);
        Permission::create(['name' => 'delete presences']);
        Permission::create(['name' => 'create presences']);
        Permission::create(['name' => 'create games']);
        Permission::create(['name' => 'edit games']);
        Permission::create(['name' => 'delete games']);
        Permission::create(['name' => 'create rankings']);
        Permission::create(['name' => 'edit rankings']);
        Permission::create(['name' => 'delete rankings']);
        Permission::create(['name' => 'edit competition']);

// create roles and assign existing permissions
        $role1 = Role::create(['name' => 'player']);
        $role1->givePermissionTo('create presences');
        $role1->givePermissionTo('edit presences');
        $role1->givePermissionTo('delete presences');

        $role2 = Role::create(['name' => 'competitionleader']);
        $role2->givePermissionTo('create presences');
        $role2->givePermissionTo('edit presences');
        $role2->givePermissionTo('delete presences');
        $role2->givePermissionTo('create games');
        $role2->givePermissionTo('edit games');
        $role2->givePermissionTo('delete games');
        $role2->givePermissionTo('create rankings');
        $role2->givePermissionTo('edit rankings');
        $role2->givePermissionTo('delete rankings');
        $role2->givePermissionTo('edit competition');


        $role3 = Role::create(['name' => 'super-admin']);
// gets all permissions via Gate::before rule; see AuthServiceProvider


    }
}
