<?php

namespace Lucid\Foundation\Providers;

use Lucid\Console\Commands\ControllerMakeCommand;
use Lucid\Console\Commands\CrudMakeCommand;
use Lucid\Console\Commands\FeatureMakeCommand;
use Lucid\Console\Commands\JobMakeCommand;
use Lucid\Console\Commands\ModelMakeCommand;
use Lucid\Console\Commands\OperationMakeCommand;
use Lucid\Console\Commands\ValidatorMakeCommand;
use Lucid\Foundation\Exceptions\Handler\JsonExceptionsHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            ExceptionHandler::class,
            JsonExceptionsHandler::class
        );

        $this->commands(
            [
                ControllerMakeCommand::class,
                ModelMakeCommand::class,
                FeatureMakeCommand::class,
                OperationMakeCommand::class,
                JobMakeCommand::class,
                ValidatorMakeCommand::class,
                CrudMakeCommand::class,
            ]
        );
    }
}
