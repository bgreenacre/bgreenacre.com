<?php

namespace Bgreenacre\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Config\Repository as Config;
use Bgreenacre\Posts\FileImporter as PostsImporter;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:posts {path? : Path to where post files exist.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all posts from directory';

    protected $config;
    protected $importer;
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files, Config $config, PostsImporter $importer)
    {
        parent::__construct();

        $this->files = $files;
        $this->config = $config;
        $this->importer = $importer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->argument('path') ?: $this->config->get('blog.paths.posts');

        $path = realpath($path);

        if ( ! $path)
        {
            $this->error('Invalid path for File Importer.');

            exit(1);
        }

        $files = glob($path . '/*.md');

        foreach ($files as $file)
        {
            try
            {
                $this->importer->import($file);
            }
            catch (Exception $e)
            {
                $this->error($e->getMessage());
                $this->error('Exiting...');
                exit(1);
            }
        }
    }
}
