<?php

use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminVocabulariesController;
use App\Http\Controllers\Admin\AdminStudentResultController;
use App\Http\Controllers\Admin\AdminHomeworkController;
use App\Http\Controllers\Admin\AdminhomeworkQuestionController;
use App\Http\Controllers\Admin\AdminHomeworkTypesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['prefix'=>'export', 'as'=>'export.'], function(){
        Route::post('/students-results', [AdminStudentController::class, 'export'])->name('students-results');
    });
    Route::group(['prefix' => 'student-results', 'as' => 'student-results.'], function () {
        Route::controller(AdminStudentResultController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    Route::group(['prefix' => 'vocabularies', 'as' => 'vocabularies.'], function () {
        Route::controller(AdminVocabulariesController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
        Route::controller(AdminStudentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/edit/{id}', 'update')->name('update');
        });
    });

    Route::group(['prefix' => 'homework', 'as' => 'homework.'], function () {
        Route::controller(AdminHomeworkController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/edit/{id}', 'update')->name('update');
            Route::delete('/delete-homework/{id}', 'destroy')->name('destroy');
        });
    });

    Route::group(['prefix' => 'homework-questions', 'as' => 'homework-questions.'], function () {
        Route::controller(AdminHomeworkQuestionController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::get('/', 'index')->name('index');
            Route::post('/process/image', 'processImage')->name('processImage');
            Route::post('/generate-correct-answers', 'generateCorrectAnswers')->name('generateCorrectAnswers');
            Route::post('/store', 'store')->name('store');
            Route::delete('/delete-homework-question/{id}', 'destroy')->name('destroy');
        });
    });

    Route::group(['prefix' => 'homework-types', 'as' => 'homework-types.'], function () {
        Route::controller(AdminHomeworkTypesController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/edit/{id}', 'update')->name('update');
            Route::delete('/delete-homework-type/{id}', 'destroy')->name('destroy');
        });
    });
});
