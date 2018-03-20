<?php

use Illuminate\Database\Seeder;
use App\User;

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
                    'level' => 0,
        			'active' => 1,
        		]
        	);
        }

        $users = User::all();
        foreach($users as $user)
        {
            $user->slug = str_slug($user->name);
            $user->save();
        }
    }
}
