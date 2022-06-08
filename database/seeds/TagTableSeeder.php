<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'title'=>'leather',
            'description'=>'this is made up of laether'
        ]);
        Tag::create([
            'title'=>'wool',
            'description'=>'this is made up of wool'
        ]);
    }
}
