<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\Student\StudentHomeworkInterface;
use App\Services\Student\StudentHomeworkService;
use App\Interface\Student\StudentHomeworkResultInterface;
use App\Services\Student\StudentHomeworkResultService;
use App\Interface\Admin\AdminHomeworkInterface;
use App\Interface\Admin\AdminStudentInterface;
use App\Services\Admin\AdminHomeworkService;
use App\Services\Admin\AdminStudentService;
use App\Interface\Admin\AdminHomeworkQuestionInterface;
use App\Services\Admin\AdminHomeworkQuestionServic;
use App\Interface\Admin\AdminHomeworkTypeInterface;
use App\Services\Admin\AdminHomeworkTypeService;
use App\Interface\Student\StudentHomeworkSubmissionInterface;
use App\Services\Student\StudentHomeworkSubmissionService;
use App\Observers\HomeworkSubmissionObserver;
use App\Models\HomeworkSubmission;
use App\Interface\Admin\AdminStudentResultInterface;
use App\Services\Admin\AdminStudentResultService;

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
        $this->app->bind(AdminStudentInterface::class, AdminStudentService::class);
        $this->app->bind(AdminHomeworkQuestionInterface::class, AdminHomeworkQuestionServic::class);
        $this->app->bind(AdminHomeworkTypeInterface::class, AdminHomeworkTypeService::class);
        $this->app->bind(AdminHomeworkTypeInterface::class, AdminHomeworkTypeService::class);
        $this->app->bind(StudentHomeworkSubmissionInterface::class, StudentHomeworkSubmissionService::class);
        $this->app->bind(AdminStudentResultInterface::class, AdminStudentResultService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        HomeworkSubmission::observe(HomeworkSubmissionObserver::class);
    }
}
