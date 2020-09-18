<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        //user
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        //company
        Permission::create(['name' => 'edit companies']);
        Permission::create(['name' => 'delete companies']);
        Permission::create(['name' => 'create companies']);
        Permission::create(['name' => 'list companies']);
        Permission::create(['name' => 'view companies']);
        //godown
        Permission::create(['name' => 'edit godown']);
        Permission::create(['name' => 'delete godown']);
        Permission::create(['name' => 'create godown']);
        Permission::create(['name' => 'list godown']);
        Permission::create(['name' => 'view godown']);
        //category
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'list category']);
        Permission::create(['name' => 'view category']);
        //subcategory
        Permission::create(['name' => 'edit subcategory']);
        Permission::create(['name' => 'delete subcategory']);
        Permission::create(['name' => 'create subcategory']);
        Permission::create(['name' => 'list subcategory']);
        Permission::create(['name' => 'view subcategory']);
        //type
        Permission::create(['name' => 'edit type']);
        Permission::create(['name' => 'delete type']);
        Permission::create(['name' => 'create type']);
        Permission::create(['name' => 'list type']);
        Permission::create(['name' => 'view type']);
        //batch
        Permission::create(['name' => 'edit batch']);
        Permission::create(['name' => 'delete batch']);
        Permission::create(['name' => 'create batch']);
        Permission::create(['name' => 'list batch']);
        Permission::create(['name' => 'view batch']);
        //challans
        Permission::create(['name' => 'challan-in']);
        Permission::create(['name' => 'challan-out']);

        $roleSuper = Role::create(['name' => 'super-admin']);

        $role1 = Role::create(['name' => 'moderator']);
        //godown
        $role1->givePermissionTo('edit godown');
        $role1->givePermissionTo('delete godown');
        $role1->givePermissionTo('create godown');
        $role1->givePermissionTo('list godown');
        $role1->givePermissionTo('view godown');
        //category
        $role1->givePermissionTo('edit category');
        $role1->givePermissionTo('delete category');
        $role1->givePermissionTo('create category');
        $role1->givePermissionTo('list category');
        $role1->givePermissionTo('view category');
        //subcategory
        $role1->givePermissionTo('edit subcategory');
        $role1->givePermissionTo('delete subcategory');
        $role1->givePermissionTo('create subcategory');
        $role1->givePermissionTo('list subcategory');
        $role1->givePermissionTo('view subcategory');
        //type
        $role1->givePermissionTo('edit type');
        $role1->givePermissionTo('delete type');
        $role1->givePermissionTo('create type');
        $role1->givePermissionTo('list type');
        $role1->givePermissionTo('view type');
        //batch
        $role1->givePermissionTo('edit batch');
        $role1->givePermissionTo('delete batch');
        $role1->givePermissionTo('create batch');
        $role1->givePermissionTo('list batch');
        $role1->givePermissionTo('view batch');
        //challan
        $role1->givePermissionTo('challan-in');
        $role1->givePermissionTo('challan-out');

        $role2 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('challan-in');
        $role1->givePermissionTo('challan-out');

        $user = \App\User::create([
            'name' => 'super-admin',
            'email' => 'admin@admin.com',
            'phone' => '9846587260',
            'password' => bcrypt('123456789')
        ]);
        $user->assignRole($roleSuper);
    }
}
