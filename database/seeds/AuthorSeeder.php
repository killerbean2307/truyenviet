<?php

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for($i = 0; $i< $limit; $i++)
        {
        	DB::table('author')->insert(
        		[
        			'name' => $faker->name,
        			'status' => $faker->numberBetween(0,1)
        		]
        	);
        }
    }
}
