<?php 
namespace Hzh;

use Illuminate\Support\ServiceProvider;
use Hzh\Commands\GenerateSeederCommand;

class MyLibraryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateSeederCommand::class,
            ]);
        }
    }
}
