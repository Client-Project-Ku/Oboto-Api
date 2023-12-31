<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\PlaceCategoryController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\PlaceFacilityController;
use App\Http\Controllers\Api\ReviewController;

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

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::get('/user',[AuthController::class, 'user']);

    Route::post('/profile',[AuthController::class, 'updateProfile']);
    Route::post('/profile/password',[AuthController::class, 'updatePassword']);

    Route::apiResource('/categories', CategoryController::class);

    Route::apiResource('/facilities', FacilityController::class);

    Route::apiResource('/districts', DistrictController::class);

    Route::apiResource('/places', PlaceController::class);
    Route::get('/events', [PlaceController::class, 'getPlaceEvent']); 
    
    Route::apiResource('/bookmarks', BookmarkController::class);

    Route::apiResource('/reviews', ReviewController::class)->except(['index', 'show', 'update']);

    Route::apiResource('/images', ImageController::class)->except(['index', 'show']);

    Route::apiResource('/places.facilities', PlaceFacilityController::class)->except(['index', 'show']);

    Route::apiResource('places.categories', PlaceCategoryController::class);
});