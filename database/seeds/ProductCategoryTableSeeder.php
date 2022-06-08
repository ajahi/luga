<?php

use Illuminate\Database\Seeder;
use App\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'title'=>'bag',
            'description'=>'this is a bag',
            'slug'=>'bag',
            'position'=>1
        ]);
        ProductCategory::create([
            'title'=>'apparel',
            'description'=>'this is apparel',
            'slug'=>'apparel',
            'position'=>2
        ]);
        ProductCategory::create([
            'title'=>'lady bag',
            'description'=>'this is organic bag',
            'slug'=>'lady-bag',
            'parent_id'=>1,
            'position'=>3
        ]);
        ProductCategory::create([
            'title'=>'granny bag',
            'description'=>'this is strong natural bag',
            'parent_id'=>1,
            'slug'=>'granny-bag',
            'position'=>4
        ]);
        ProductCategory::create([
            'title'=>'zebra jhola',
            'description'=>'this is big bag',
            'slug'=>'zebra-jhola',
            'parent_id'=>1,
            'position'=>2
        ]);
    }
}
