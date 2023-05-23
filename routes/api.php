<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['throttle:api', 'accept-json'])->group(function () {

    Route::get('/company/{ids}',  [CompanyController::class, 'index']);
    Route::post('/company',  [CompanyController::class, 'store']);
    Route::match(['PUT', 'PATCH'], '/company/{id}',  [CompanyController::class, 'update']);

    /** Query test */
    Route::get('company-foundation', [CompanyController::class, 'foundation']);
    Route::get('company-activity', [CompanyController::class, 'activity']);
});

