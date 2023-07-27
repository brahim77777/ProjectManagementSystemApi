<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Event\Code\Throwable;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

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


Route::apiResource('projects' , ProjectController::class)->middleware('auth:api');
Route::apiResource('tasks' , TaskController::class)->middleware('auth:api');


Route::get('/login' , [LoginController::class , 'login']);
// Route::fallback(function () {
//     report(new Exception());
//     return response('This Url Is Not Defined' , 404);
// } );