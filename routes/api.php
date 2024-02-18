<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\NewsCotroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::apiResource('/category', CategoriesController::class);
Route::get('news', [NewsCotroller::class, 'AllNews']);
Route::get('news/{id}', [NewsCotroller::class, 'ShowNews']);
Route::apiResource('/comment', CommentController::class);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('/mynews', NewsCotroller::class);
    Route::apiResource('/custompage', CustomPageController::class);
});
