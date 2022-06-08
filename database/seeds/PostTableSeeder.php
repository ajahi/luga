<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;


class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Factory::create();
        // $category = Category::pluck('id')->toArray();

        // for ($i = 0; $i < 5; $i++) {
        //     $title = $faker->unique()->sentence;
        //     $slug = Str::slug($title);

        //     Post::create([
        //         'title'=>$title,
        //         'slug' => $slug,
        //         'category_id' => $category[rand(0, count($category) - 1)],
        //         'status' => $faker->randomElement($array = array ('published','draft')),
        //         'icon' => 'fa-none',
        //         'description' => $faker->paragraph,
        //         'attributes' => '{}',
        //         'user_id'=>1
        //     ]);

        // }
        // $about=Post::create([
        //     'title'=>'about-us',
        //     'slug' => 'about-us',
        //     'category_id' => 1,
        //     'status' => 'published',
        //     'icon' => 'fa-none',
        //     'description' => $faker->paragraph,
        //     'attributes' => '{}',
        //     'user_id'=>1
        // ]);
        // $about->save();
        // $blogs=Post::create([
        //     'title'=>'blogs',
        //     'slug' => 'blogs',
        //     'category_id' => 2,
        //     'status' => 'published',
        //     'icon' => 'fa-none',
        //     'description' => $faker->paragraph,
        //     'attributes' => '{}',
        //     'user_id'=>1
        // ]);
        // $blogs->save();

    }
}
