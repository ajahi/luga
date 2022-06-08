<?php

use Illuminate\Database\Seeder;
use App\Site;
use Faker\Factory;

class SitesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Factory::create();
            Site::create([
                'title'=>$faker->word,
                'slogan'=>$faker->word,
                'description'=>$faker->paragraph,
                'website'=>$faker->word .".com",
                'email'=>$faker->email,
                'location'=>$faker->word,
                'telephone'=>$faker->phoneNumber,
                'working_days'=>$faker->numberBetween(2,10),
                'facebook'=>$faker->word,
                'google'=>$faker->word,
                'twitter'=>$faker->word,
                'instagram'=>$faker->word,
                'linkedin'=>$faker->word,
                'skype'=>$faker->word,
                'attributes'=>json_encode(array()),
                'created_at'=>$faker->dateTime,
                'updated_at'=>$faker->dateTime
            ]);
        }
}
