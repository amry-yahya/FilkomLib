<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view books']);
        Permission::create(['name' => 'create books']);
        Permission::create(['name' => 'edit books']);
        Permission::create(['name' => 'delete books']);
        Permission::create(['name' => 'borrow books']);
        Permission::create(['name' => 'manage borrowings']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view books');
        $adminRole->givePermissionTo('create books');
        $adminRole->givePermissionTo('edit books');
        $adminRole->givePermissionTo('delete books');
        $adminRole->givePermissionTo('manage borrowings');

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('view books');
        $userRole->givePermissionTo('borrow books');


        $user = User::factory()->create([
            'name' => 'Example admin user',
            'email' => 'admin@email.com',
            'nim' => '205150200111064',
            'password' => bcrypt('soloplayer')
        ]);
        $user->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'Example user user',
            'email' => 'user@email.com',
            'nim' => '205150200111065',
            'password' => bcrypt('soloplayer')
        ]);
        $user->assignRole($userRole);
    }
}
