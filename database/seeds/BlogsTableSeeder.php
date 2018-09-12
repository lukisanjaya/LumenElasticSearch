<?php

use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Blog::class, 5000)->create()->each(function ($u) {
            // $u->posts()->save(factory(App\Model\Blog::class)->make());
        });
    }
}
