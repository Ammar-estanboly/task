<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AssignUserProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::find(1)->products()->attach([1,2,3]);
        User::find(2)->products()->attach([4,3]);
        User::find(3)->products()->attach([1,5]);
        User::find(4)->products()->attach([2,5]);


    }
}
