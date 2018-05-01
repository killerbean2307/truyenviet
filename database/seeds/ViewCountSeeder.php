<?php

use Illuminate\Database\Seeder;
use App\Story;
use App\ViewCount;
class ViewCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $stories = Story::all();

        foreach($stories as $story)
        {
            DB::table('view_count')->insert(
                [
                    'story_id' => $story->id,
                    'day_view' => $faker->numberBetween(1,1000),
                    'week_view' => $faker->numberBetween(1,10000),
                    'month_view' => $faker->numberBetween(1,100000),
                ]
            );
        }
    }
}
