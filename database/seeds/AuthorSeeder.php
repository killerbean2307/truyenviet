<?php

use Illuminate\Database\Seeder;
use App\Author;


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
        			'status' => $faker->numberBetween(0,1),
                    'detail' => $faker->realText(),
        		]
        	);
        }

        $authors = Author::all();
        foreach($authors as $author)
        {
            $author->slug = str_slug($author->name);
            $author->save();
        }
    }
}
