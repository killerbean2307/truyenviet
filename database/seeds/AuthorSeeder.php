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
        			'status' => $faker->numberBetween(0,1),
                    'detail' => $faker->realText(),
                    'image' => $faker->image('/upload',640,480)// '13b73edae8443990be1aa8f1a483bc27.jpg' it's a filename without path
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
