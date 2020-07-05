<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh all dataase and seed the default data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$this->line('This command has been run');
        $this->call('migrate:refresh');

        // bisa kode
        $categories = collect(['Framework', 'Code']);
        $categories->each(function ($cat) {
            \App\Category::create([
                'name' => $cat,
                'slug' => \Str::slug($cat)
            ]);
        });

        $tags = collect(['Fastify', 'Deno Land']);
        $tags->each(function ($tag) {
            \App\Category::create([
                'name' => $tag,
                'slug' => \Str::slug($tag)
            ]);
        });
        $this->info('All database has been refreshed and seeded.');
    }
}
