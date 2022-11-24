<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::create([
            'name'  => 'product 1',
            'image' =>'images/product/1669280861-FB_IMG_15493186474428412.jpg',
            'description'=> 'descriptiondescription	description	description	description'
        ]);
        Product::create([
            'name'  => 'product 2',
            'image' =>'images/product/1669280861-FB_IMG_15493186474428412.jpg',
            'description'=> 'descriptiondescription	description	description	description'
        ]);
        Product::create([
            'name'  => 'product 3',
            'image' =>'images/product/1669280861-FB_IMG_15493186474428412.jpg',
            'description'=> 'descriptiondescription	description	description	description'
        ]);
        Product::create([
            'name'  => 'prorduct 4',
            'image' =>'images/product/1669280861-FB_IMG_15493186474428412.jpg',
            'description'=> 'descriptiondescription	description	description	description'
        ]);

        Product::create([
            'name'  => 'prorduct 5',
            'image' =>'images/product/1669280861-FB_IMG_15493186474428412.jpg',
            'description'=> 'descriptiondescription	description	description	description'
        ]);
    }
}
