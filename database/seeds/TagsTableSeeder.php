<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Fastify', 'Deno Land']);
        $tags->each(function ($tag) {
            \App\Tag::create([
                'name' => $tag,
                'slug' => \Str::slug($tag)
            ]);
        });
    }
}
