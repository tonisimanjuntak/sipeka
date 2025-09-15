<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class AutoRouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $controllerPath = app_path('Http/Controllers');
        $files = File::allFiles($controllerPath);

        foreach ($files as $file) {
            $className = 'App\\Http\\Controllers\\' . str_replace(
                ['/', '.php'],
                ['\\', ''],
                $file->getRelativePathname()
            );

            if (!class_exists($className)) continue;

            $reflector = new \ReflectionClass($className);
            if ($reflector->isAbstract() || $reflector->isInterface()) continue;

            foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->class !== $className || $method->isConstructor()) continue;

                $routeName = strtolower($reflector->getShortName()) . '.' . $method->getName();
                $uri = str_replace(
                    '\\',
                    '/',
                    str_replace(
                        'Controller',
                        '',
                        $reflector->getShortName()
                    ) . '/' . $method->getName()
                );

                Route::get($uri, [$className, $method->getName()])->name($routeName);
            }
        }
    }
}
