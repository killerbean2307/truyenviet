<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
        $this->call(UserSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(StorySeeder::class);
        $this->call(ChapterSeeder::class);
        $this->call(ViewCountSeeder::class);
    }
}
