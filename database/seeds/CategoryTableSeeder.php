<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Populate Categories
        factory(App\Models\Category::class, 10)->create();

        // Get all the categories attaching up to 3 random roles to each user
        $categories = App\Models\Category::all();

        // Populate the pivot table
        App\Models\Post::all()->each(function ($post) use ($categories) { 
            $post->categories()->attach(
                $categories->random(rand(1, 10))->pluck('id')->toArray()
            ); 
        });
    }
}
