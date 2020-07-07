<?php


namespace Zijinghua\Zbasement;

use Zijinghua\Basement\Http\Models\Contracts\MessageModelInterface;
use Zijinghua\Zbasement\Http\Models\MessageConfig;
use Zijinghua\Zbasement\Http\Repositories\Contracts\MessageRepositoryInterface;
use Zijinghua\Zbasement\Http\Repositories\MessageRepository;
use Zijinghua\Zbasement\Http\Responses\MessageResponse;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Zijinghua\Zbasement\Http\Responses\Contracts\MessageResponseInterface;
use Zijinghua\Zbasement\Http\Models\Contracts\UserModelInterface;
use Zijinghua\Zbasement\Http\Models\User;
use Zijinghua\Zbasement\Http\Services\BaseService;
use Zijinghua\Zbasement\Http\Services\Contracts\BaseServiceInterface;
use Zijinghua\Zbasement\Http\Repositories\BaseRepository;
use Zijinghua\Zbasement\Facades\Zsystem as ZsystemFacade;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * 在服务容器里注册
     *
     * @return void
     */
    public function register()
    {
        $this->bindingClass();

        if ($this->app->runningInConsole()) {
            $this->registerConsoleCommands();
        }

        $this->registerConfigs();
        $this->loadHelpers();
    }

    public function bindingClass()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Zsystem', ZsystemFacade::class);
        $this->app->singleton('zsystem', function () {
            return new Zsystem();
        });

        $loader->alias('baseRepository', BaseRepositoryInterface::class);
        $this->app->singleton('baseRepository', function () {
            return new BaseRepository();
        });

        $loader->alias('messageRepository', MessageRepositoryInterface::class);
        $this->app->singleton('messageRepository', function () {
            return new MessageRepository();
        });


        $loader->alias('baseService', BaseServiceInterface::class);
        $this->app->singleton('baseService', function () {
            return new BaseService();
        });

        $loader->alias('userModel', UserModelInterface::class);
        $this->app->singleton('userModel', function () {
            return new User();
        });

        $loader->alias('messageModel', MessageModelInterface::class);
        $this->app->singleton('messageModel', function () {
            return new MessageConfig();
        });

        $loader->alias('messageResponse', MessageResponseInterface::class);
        $this->app->bind('messageResponse', function () {
            return new MessageResponse();
        });
    }

    public function registerConsoleCommands()
    {
        $this->commands(Commands\Install::class);
    }

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/validation.php', 'zbasement.validation'
        );
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/code.php', 'zbasement.code'
        );
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

}

