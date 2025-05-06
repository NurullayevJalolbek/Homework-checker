<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\Student\StudentHomeworkInterface;
use App\Services\Student\StudentHomeworkService;
use App\Interface\Student\StudentHomeworkResultInterface;
use App\Services\Student\StudentHomeworkResultService;
use App\Interface\Admin\AdminHomeworkInterface;
use App\Services\Admin\AdminHomeworkService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StudentHomeworkInterface::class, StudentHomeworkService::class);
        $this->app->bind(StudentHomeworkResultInterface::class, StudentHomeworkResultService::class);
        $this->app->bind(AdminHomeworkInterface::class, AdminHomeworkService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
