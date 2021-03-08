<?php


namespace Aoeng\Laravel\Support;

use Aoeng\Laravel\Support\Commands\ModelInstall;
use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ModelInstall::class,
            ]);
        }
    }

}
