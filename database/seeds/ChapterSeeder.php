<?php

use Illuminate\Database\Seeder;

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
                    'content' => $faker->realText(500),
                    'ordering' => $faker->numberBetween(1,10)
        		]
        	);
        }
    }
}
