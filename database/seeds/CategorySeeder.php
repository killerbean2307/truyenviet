<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
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
        	DB::table('category')->insert(
        		[
        			'name' => $faker->name,
        			'description' => $faker->realText,
        		]
        	);
        }

        $categories = Category::all();
        foreach($categories as $category)
        {
            $category->slug = str_slug($category->name);
            $category->save();
        }
    }
}
