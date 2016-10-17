<?php
namespace App\Modules;

/**
 * ServiceProvider
 *
 * The service provider for the modules. After being registered it will male sure that
 * each of the modules are properly loaded with their routes,views etc
 */

class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
    
    public function boot()
    {
        $modules = config('module.modules');

        while (list($module) = each($modules)) {

            // Load the routes files
            $path = implode(DIRECTORY_SEPARATOR, [__DIR__, $module, 'routes.php']);
            if (file_exists($path)) {
                require_once $path;
            }

            // load the views
            $viewDir = implode(DIRECTORY_SEPARATOR, [__DIR__, $module, 'Views']);
            if (is_dir($viewDir)) {
                $this->loadViewsFrom($viewDir, $module);
            }
        }
    }


    public function register() {}

}
