<?php

use Illuminate\Database\Seeder;
use App\Chapter;


class ChapterSeeder extends Seeder
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
        	DB::table('chapter')->insert(
        		[
        			'name' => $faker->name,
        			'story_id' => $faker->numberBetween(1,100),
                    'user_id' => 1,
                    'content' => $faker->realText(500),
                    'ordering' => $faker->numberBetween(1,10)
        		]
        	);
        }
    }
}
