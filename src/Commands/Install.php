<?php

namespace Zijinghua\Zbasement\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fm:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this package init';

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
    public function handle(Filesystem $filesystem)
    {
        $this->publishRoutes($filesystem);
    }

    private function publishRoutes($filesystem){
        $this->info('Publish snack.php route to routes/api.php');
        $contents = $filesystem->get(base_path('routes/api.php'));
        if (false === strpos($contents, 'Zsystem::routes()')) {
            $filesystem->append(
                base_path('routes/api.php'),
                "\n\nRoute::group(['middleware' => 'api', 'prefix' => 'v1'], function() {\n".
                "\tZijinghua\Basement\Zsystem::routes();\n});\n"
            );
        }
    }
}
