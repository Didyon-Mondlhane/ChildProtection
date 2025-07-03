<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ProhibitedActivityController;
use App\Http\Controllers\CountryActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SavedQueryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ComparisonController;

Route::get('/', [ComparisonController::class, 'index']);

Route::resource('countries', CountryController::class);
Route::resource('sectors', SectorController::class);
Route::resource('prohibited_activities', ProhibitedActivityController::class);
Route::resource('country_activities', CountryActivityController::class);
Route::resource('categories', CategoryController::class);
Route::resource('query_saved_results', SavedQueryController::class);
Route::resource('comments', CommentController::class);
Route::resource('comparisons', ComparisonController::class);

Route::get('/comparisons/{id}/exports/{format}', [ComparisonController::class, 'export'])
    ->name('comparisons.export');