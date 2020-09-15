<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's use factories to create a couple of posts on the db with users assgined.
        factory(App\User::class, 20)->create()->each(function ($user) {
            $user->posts()->createMany(factory(App\Post::class, 5)->make()->toArray());
        });
    }
}
