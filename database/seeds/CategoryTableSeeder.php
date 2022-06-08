<?php

use App\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;


class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([
            'title' => 'About us ',
            'slug' => slug(strtolower('About us')),
            'description' => 'This stores the information of about us category',
            'position'=>1,
            'attributes'=>
                json_encode([])
        ]);
        
        DB::table('categories')->insert([
            'title' => 'Videos',
            'slug' => slug(strtolower('Videos')),
            'description' => 'This store the information of videos',
            'position'=>3,
            'attributes'=>
                json_encode([])

        ]);

        DB::table('categories')->insert([
            'title' => 'Blogs',
            'slug' => slug(strtolower('Blogs')),
            'description' => 'This store the information of blog category',
            'position'=>4,
            'attributes'=>
                json_encode([])

        ]);
        
        DB::table('categories')->insert([
            'title' => 'Testimonial',
            'slug' => slug(strtolower('Testimonial')),
            'description' => 'This store the information of testimonials',
            'position'=>5,
            'attributes'=>
                json_encode([])

        ]);

        DB::table('categories')->insert([
            'title' => 'Gallery',
            'slug' => slug(strtolower('Gallery')),
            'description' => 'This store the information of gallery',
            'position'=>6,
            'attributes'=>
                json_encode([])

        ]);



        

    }
}
