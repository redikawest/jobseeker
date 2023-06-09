<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VacancyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('candidate')
    ->group(function () {
        Route::get('', [CandidateController::class, 'getAll']);
        Route::post('', [CandidateController::class, 'create']);
        Route::put('/{candidateId}', [CandidateController::class, 'update']);
        Route::delete('/{candidateId}', [CandidateController::class, 'delete']);
        Route::post('/apply', [CandidateController::class, 'setApplication']);
    });

Route::prefix('vacancy')
    ->group(function () {
        Route::get('', [VacancyController::class, 'getAll']);
        Route::post('', [VacancyController::class, 'create']);
        Route::put('/{vacancyId}', [VacancyController::class, 'update']);
        Route::delete('/{vacancyId}', [VacancyController::class, 'delete']);
    });
