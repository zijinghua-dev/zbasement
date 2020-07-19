<?php

namespace Zijinghua\Zbasement\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Zijinghua\Zvoyager\Base;
use Zijinghua\Zvoyager\ZServiceProvider;

class PublishRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'zbasement:publishRoutes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish routes for user login and register.';


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
                "\n\nRoute::group(['middleware' => 'api', 'prefix' =>'". getConfigValue('zbasement.api.version')."'], function() {\n".
                "\tZijinghua\Basement\Zsystem::routes();\n});\n"
            );
        }
    }
}
