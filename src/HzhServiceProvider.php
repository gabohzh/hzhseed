<?php 
namespace Hzh\Seeder;

use Illuminate\Support\ServiceProvider;
use Hzh\Seeder\Commands\GenerateSeederCommand;

class HzhServiceProvider extends ServiceProvider
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
