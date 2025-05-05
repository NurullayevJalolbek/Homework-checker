<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentHomeworkResultController;
use App\Http\Controllers\Student\StudentHomeworkController;
use App\Http\Controllers\Student\StudentHomeworkSubmissionController;
use App\Http\Controllers\Student\StudentVocabularyPracticeController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminVocabulariesController;
use App\Http\Controllers\Admin\AdminStudentResultController;
use App\Http\Controllers\Admin\AdminHomeworkController;
use App\Http\Controllers\Admin\AdminhomeworkQuestionController;
use App\Http\Controllers\Admin\AdminHomeworkTypesController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/', function () {
        return view('layouts.app');
    })->name('home');
    
    Route::group(['prefix'=>'admin', 'as'=>'admin.'], function(){

        Route::group(['prefix'=>'student-results', 'as'=>'student-results.'], function(){
            Route::controller(AdminStudentResultController::class)->group(function(){
                Route::get('/','index')->name('index');
            });
        });

        Route::group(['prefix'=>'vocabularies', 'as'=>'vocabularies.'], function(){
            Route::controller(AdminVocabulariesController::class)->group(function(){
                Route::get('/', 'index')->name('index');
            });
        });



        Route::group(['prefix'=>'students', 'as'=>'students.'], function(){
            Route::controller(AdminStudentController::class)->group(function(){
                Route::get('/', 'index')->name('index');
            });
        });

        Route::group(['prefix'=>'homework', 'as'=>'homework.'], function(){
            Route::controller(AdminHomeworkController::class)->group(function(){
                Route::get('/', 'index')->name('index');
            });
        });

        Route::group(['prefix'=>'homework-questions', 'as'=>'homework-questions.'], function(){
            Route::controller(AdminHomeworkQuestionController::class)->group(function(){
                Route::get('/', 'index')->name('index');
            });
        });

        Route::group(['prefix'=>'homework-types', 'as'=>'homework-types.'], function(){
            Route::controller(AdminHomeworkTypesController::class)->group(function(){
                Route::get('/', 'index')->name('index');
            });
        });

    });

    Route::group(['prefix' => 'student-homeworks', ], function () {
        Route::controller(StudentHomeworkController::class)->group(function () {
            Route::get('/', 'index')->name('students.homework.index');
        });
    
        Route::group(['prefix' => 'submissions'], function () {
            Route::controller(StudentHomeworkSubmissionController::class)->group(function () {
                Route::get('/', 'index')->name('students.homework-submissions.index');
            });
        });
    
        Route::group(['prefix' => 'results'], function () {
            Route::controller(StudentHomeworkResultController::class)->group(function () {
                Route::get('/', 'index')->name('students.homework-results.index');
            });
        });
    });
    
    Route::group(['prefix'=>'student-vocabulary-practice'], function(){
        Route::controller(StudentVocabularyPracticeController::class)->group(function(){
            Route::get('/', 'index')->name('students.vocabulary-practice.index');
        });
    });
});

require __DIR__.'/auth.php';
