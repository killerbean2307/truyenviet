<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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

        for($i = 0; $i<$limit; $i++)
        {
        	DB::table('users')->insert(
        		[
        			'name' => $faker->name,
        			'email' => $faker->email,
        			'password' => $faker->password,
        			'active' => 1,
                    'image' => $faker->image($dir = '', $width = 640, $height = 480)
        		]
        	);
        }

        $users = Users::all();
        foreach($users as $user)
        {
            $user->slug = str_slug($user->name);
            $user->save();
        }
    }
}
