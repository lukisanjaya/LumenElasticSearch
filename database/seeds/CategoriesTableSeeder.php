<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Category::class, 50)->create()->each(function ($u) {
            // $u->posts()->save(factory(App\Model\Category::class)->make());
        });
    }
}
