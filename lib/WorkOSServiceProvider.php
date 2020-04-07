<?php

namespace WorkOS\Laravel;

use Illuminate\Support\ServiceProvider;

/**
 * Class WorkOSServiceProvider.
 */
class WorkOSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the ServiceProvider.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [__DIR__."/../config/workos.php" => config_path("workos.php")]
            );
        }
    }

    /**
     * Register the ServiceProvider as well as setup WorkOS.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__."/../config/workos.php", "workos");

        $config = $this->app["config"]->get("workos");
        \WorkOS\WorkOS::setApiKey($config["api_key"]);
        \WorkOS\WorkOS::setProjectId($config["project_id"]);
    }
}
