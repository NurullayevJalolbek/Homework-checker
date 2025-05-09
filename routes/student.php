<?php

use App\Http\Controllers\Student\StudentHomeworkResultController;
use App\Http\Controllers\Student\StudentHomeworkController;
use App\Http\Controllers\Student\StudentHomeworkSubmissionController;
use App\Http\Controllers\Student\StudentVocabularyPracticeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'student-homeworks'], function () {
    Route::controller(StudentHomeworkController::class)->group(function () {
        Route::get('/', 'index')->name('students.homework.index');
    });

    Route::group(['prefix' => 'submissions'], function () {
        Route::controller(StudentHomeworkSubmissionController::class)->group(function () {
            Route::get('/', 'index')->name('students.homework-submissions.index');
            Route::get('/create/{id}', 'create')->name('students.homework-submissions.create');
            Route::post('/store', 'store')->name('students.homework-submissions.store');
            Route::get('/{id}/accept', 'accept')->name('students.homework-submissions.accept');
        });
    });

    Route::group(['prefix' => 'results'], function () {
        Route::controller(StudentHomeworkResultController::class)->group(function () {
            Route::get('/', 'index')->name('students.homework-results.index');
        });
    });
});

Route::group(['prefix' => 'student-vocabulary-practice'], function () {
    Route::controller(StudentVocabularyPracticeController::class)->group(function () {
        Route::get('/', 'index')->name('students.vocabulary-practice.index');
    });
});
