<?php


namespace Zijinghua\Zbasement;

use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Models\Activity as ActivityModel;
use Zijinghua\Basement\Http\Models\Contracts\MessageModelInterface;
use Zijinghua\Zbasement\Http\Models\Contracts\ValidationModelInterface;
use Zijinghua\Zbasement\Http\Models\CodeMessageConfig;
use Zijinghua\Zbasement\Http\Models\ValidationConfig;
use Zijinghua\Zbasement\Http\Repositories\Contracts\CodeMessageRepositoryInterface;
use Zijinghua\Zbasement\Http\Repositories\CodeMessageRepository;
use Zijinghua\Zbasement\Http\Repositories\ValidationRepository;
use Zijinghua\Zbasement\Http\Resources\BaseResource;

use Zijinghua\Zbasement\Http\Responses\MessageResponse;
use Illuminate\Foundation\AliasLoader;

use Zijinghua\Zbasement\Http\Responses\Contracts\MessageResponseInterface;

use Zijinghua\Zbasement\Http\Services\BaseService;
use Zijinghua\Zbasement\Http\Services\CodeMessageService;
use Zijinghua\Zbasement\Http\Services\Contracts\BaseServiceInterface;
use Zijinghua\Zbasement\Http\Repositories\BaseRepository;
use Zijinghua\Zbasement\Facades\Zsystem as ZsystemFacade;
use Zijinghua\Zbasement\Http\Services\Contracts\CodeMessageServiceInterface;
use Zijinghua\Zbasement\Http\Services\Contracts\UserServiceInterface;
use Zijinghua\Zbasement\Http\Services\Contracts\ValidationServiceInterface;
use Zijinghua\Zbasement\Http\Services\UserService;
use Zijinghua\Zbasement\Http\Services\ValidationService;
use Zijinghua\Zbasement\Observers\ActivityObserver;
use Zijinghua\Zbasement\Providers\BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{
    protected static function getActivityModel()
    {
        return config('activitylog.activity_model') ?? ActivityModel::class;
    }
    public function boot()
    {
        self::getActivityModel()::observe(ActivityObserver::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                realpath(__DIR__.'/../publishable/migration') => database_path('migrations')
            ], 'migrations');
        }
    }
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

//        $loader->alias('userShowResource', UserShowResource::class);
//        $this->app->bind('userShowResource', function () {
//            return new UserShowResource();
//        });

        $loader->alias('baseResource', BaseResource::class);
//        $this->app->bind('baseListResource', function () {
//            return new BaseResource();
//        });


        $loader->alias('messageResponse', MessageResponseInterface::class);
        $this->app->bind('messageResponse', function () {
            return new MessageResponse();
        });




        $loader->alias('codeMessageModel', CodeMessageModelInterface::class);
        $this->app->singleton('codeMessageModel', function () {
            return new CodeMessageConfig();
        });

        $loader->alias('validationModel', ValidationModelInterface::class);
        $this->app->singleton('validationModel', function () {
            return new ValidationConfig();
        });


        $loader->alias('baseRepository', BaseRepositoryInterface::class);
        $this->app->singleton('baseRepository', function () {
            return new BaseRepository();
        });

        $loader->alias('codeMessageRepository', CodeMessageRepositoryInterface::class);
        $this->app->singleton('codeMessageRepository', function () {
            return new CodeMessageRepository();
        });
        $loader->alias('validationRepository', ValidationRepositoryInterface::class);
        $this->app->singleton('validationRepository', function () {
            return new ValidationRepository();
        });

        $loader->alias('baseService', BaseServiceInterface::class);
        $this->app->singleton('baseService', function () {
            return new BaseService();
        });

        $loader->alias('validationService', ValidationServiceInterface::class);
        $this->app->bind('validationService', function () {
            return new ValidationService();
        });

        $loader->alias('codeMessageService', CodeMessageServiceInterface::class);
        $this->app->bind('codeMessageService', function () {
            return new CodeMessageService();
        });

//        $loader->alias('userService', UserServiceInterface::class);
//        $this->app->singleton('userService', function () {
//            return new UserService();
//        });
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
        $this->mergeConfigFrom(

            dirname(__DIR__).'/publishable/config/fields.php', 'zbasement.fields'
        );
        $this->mergeConfigFrom(dirname(__DIR__).'/publishable/config/logging.php', 'logging.channels');
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

