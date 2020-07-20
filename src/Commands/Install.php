<?php

namespace Zijinghua\Zbasement\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Zijinghua\Zbasement\ServiceProvider;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'zbasement:install';
    protected $name = 'zbasement:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this package init';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
//        $this->publishRoutes($filesystem);
//        $this->publishConfigs();
        $this->publishMigrates();
//        $this->publishRoutes();
    }



//    private function publishConfigs(){
//        $this->info('Publish api.php configs to configs/api.php');
//        $this->call('vendor:publish', ['--provider' => ServiceProvider::class, '--tag' => ['config']]);
//        $this->call('config:clear');
//    }

    private function publishMigrates(){
        $this->info('Migrating the database tables into your application');
        $option= ['--force' => $this->option('force')];
        $this->call('migrate', $option);//
    }

//    private function publishRoutes(){
//        $this->info('Publish api.php routes to app/http/routes/api.php');
//        $this->call('vendor:publish', ['--provider' => ServiceProvider::class, '--tag' => ['route']]);
//        $this->call('route:cache');
//    }
    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            ['with-dummy', null, InputOption::VALUE_NONE, 'Install with dummy data', null],
        ];
    }
}
