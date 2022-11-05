<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1= Role::where('name','Admin')->get();
        $user1 = User::create([
             'first_name' => 'ali',
             'last_name' =>  'ali',
             'email' => 'admin@gmail.com',
             'password' => '12345678',
         ]);
         $user1->assignRole($role1);
         $role2= Role::where('name','User')->get();
         $user2 = User::create([

             'first_name' => 'ammar',
             'last_name' =>  'ammar',
             'email' => 'ammar@gmail.com',
             'password' => '12345678',

         ]);
         $user2->assignRole($role2);
    }
}
