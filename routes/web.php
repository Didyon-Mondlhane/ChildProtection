<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ProhibitedActivityController;
use App\Http\Controllers\CountryActivityController;
use App\Http\Controllers\ComparisonController;

Route::get('/', [ComparisonController::class, 'index']);

Route::resource('countries', CountryController::class);
Route::resource('sectors', SectorController::class);
Route::resource('prohibited_activities', ProhibitedActivityController::class);
Route::resource('country_activities', CountryActivityController::class);
Route::resource('comparisons', ComparisonController::class);

Route::get('/comparisons/{id}/exports/{format}', [ComparisonController::class, 'export'])
    ->name('comparisons.export');