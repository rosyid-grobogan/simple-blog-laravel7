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
        $categories = collect(['Framework', 'Code']);
        $categories->each(function ($cat) {
            \App\Category::create([
                'name' => $cat,
                'slug' => \Str::slug($cat)
            ]);
        });
    }
}
