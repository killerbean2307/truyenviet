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

        	DB::table('users')->insert(
        		[
        			'name' => 'viet',
        			'email' => 'killerbean2307',
        			'password' => '$2y$10$PAw7zBwGq0RsflI1LpZ5OOnZObr3LrI0TFeaEwwOH8FjCZVKe.P/m',
                    'level' => 2,
        			'active' => 1,
        		]);

        $users = User::all();
        foreach($users as $user)
        {
            $user->slug = str_slug($user->name);
            $user->save();
        }
    }
}
