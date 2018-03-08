<?php

use Illuminate\Database\Seeder;
use App\Story;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 100;

        for($i = 0; $i< $limit; $i++)
        {
            DB::table('story')->insert(
                [
                    'name' => $faker->name,
                    'description' => $faker->realText,
                    'category_id' => $faker->numberBetween(1,10),
                    'author_id' => $faker->numberBetween(1,10),
                    'user_id' => $faker->numberBetween(1,10),
                    'status' => $faker->numberBetween(0,2),
                ]
            );
        }

        $stories = Story::all();
        foreach($stories as $story)
        {
            $story->slug = str_slug($story->name);
            $story->save();
        }
    }
}
