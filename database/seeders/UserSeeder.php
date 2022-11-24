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
        $role1= Role::where('name','Admin')->where('guard_name','web')->get();
        $role11= Role::where('name','Admin')->where('guard_name','api')->get();
        $user1 = User::create([
             'first_name' => 'ali',
             'last_name' =>  'ali',
             'email' => 'admin@gmail.com',
             'password' => '12345678',
             'phone_number' => '0976578094'
         ]);
         $user1->assignRole($role1);
         $user1->assignRole($role11);

         $role2= Role::where('name','User')->where('guard_name','web')->get();
         $role22= Role::where('name','User')->where('guard_name','api')->get();
         $user2 = User::create([

             'first_name' => 'ammar',
             'last_name' =>  'ammar',
             'email' => 'ammar@gmail.com',
             'password' => '12345678',
             'phone_number' => '0976578095'


         ]);
         $user2->assignRole($role2);
         $user2->assignRole($role22);


         $user3 = User::create([

            'first_name' => 'ahmad',
            'last_name' =>  'ahmad',
            'email' => 'ahmad@gmail.com',
            'password' => '12345678',
            'phone_number' => '0976578092'


        ]);
        $user3->assignRole($role2);
        $user3->assignRole($role22);


        $user4 = User::create([

            'first_name' => 'sami',
            'last_name' =>  'sami',
            'email' => 'sami@gmail.com',
            'password' => '12345678',
            'phone_number' => '0976578093'


        ]);

        $user4->assignRole($role2);
        $user4->assignRole($role22);

    }
}
