<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions =[ 'add-user',
                        'show-user',
                        'update-user',
                        'show-profile',
                        'delete-user',
                        'change-password',
                        'show-user-products',
                        'add-product',
                        'show-products',
                        'show-product',//show one product
                        'edit-product',
                        'delete-product',
                        'assign-product',
                        'show-your-products', ];


        foreach($permissions as $permission){
           Permission::create(['name' => $permission,'guard_name'=>'api']);
            }

        foreach($permissions as $permission){
                Permission::create(['name' => $permission,'guard_name'=>'web']);
                 }
        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Admin','guard_name'=>'api']);
        $role11 = Role::create(['name' => 'Admin','guard_name'=>'web']);
        foreach($permissions as $permission){
                $role1->givePermissionTo($permission);
               }

        foreach($permissions as $permission){
                $role11->givePermissionTo($permission);
               }

        $role2 = Role::create(['name' => 'User','guard_name'=>'api']);
        $role22 = Role::create(['name' => 'User','guard_name'=>'web']);
        $role2->givePermissionTo('show-profile');
        $role2->givePermissionTo('change-password');
        $role2->givePermissionTo('show-your-products');

        $role22->givePermissionTo('show-profile');
        $role22->givePermissionTo('change-password');
        $role22->givePermissionTo('show-your-products');

    }
}
