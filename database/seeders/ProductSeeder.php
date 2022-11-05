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
            'image' =>'product/1667582097-Tishreen_University_logo.png',
            'description'=> 'descriptiondescription	description	description	description'
        ]);
        Product::create([
            'name'  => 'product 2',
            'image' =>'product/1667582097-Tishreen_University_logo.png',
            'description'=> 'descriptiondescription	description	description	description'
        ]);
        Product::create([
            'name'  => 'product 3',
            'image' =>'product/1667582097-Tishreen_University_logo.png',
            'description'=> 'descriptiondescription	description	description	description'
        ]);
        Product::create([
            'name'  => 'prorduct 4',
            'image' =>'product/1667582097-Tishreen_University_logo.png',
            'description'=> 'descriptiondescription	description	description	description'
        ]);
    }
}
