<?php

namespace Bgreenacre\Console\Commands;

use Illuminate\Console\Command;
use Bgreenacre\Posts\PostModel;

class PostsShow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all posts.';

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
     * @return mixed
     */
    public function handle()
    {
        $headers = ['ID', 'Title'];

        $posts = PostModel::all(['id', 'title'])->toArray();

        $this->table($headers, $posts);
    }

}
