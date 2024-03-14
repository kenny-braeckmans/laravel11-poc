<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\PillarController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WeekController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('administrators', AdministratorController::class);

Route::apiResource('projects', ProjectController::class);

Route::apiResource('beneficiaries', BeneficiaryController::class);

Route::apiResource('pillars', PillarController::class);

Route::apiResource('registrations', RegistrationController::class);

Route::apiResource('weeks', WeekController::class);