<?php

use App\Http\Controllers\api\LoginController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// user 
Route::prefix('/user')->group(function () {
    Route::post('login', 'api\LoginController@login');
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/settings', 'api\SettingController@store');
        Route::get('/allgenres', 'api\GenreController@index');
        Route::get('/allmovies', 'api\MovieController@index');
        Route::get('/filter', 'api\MovieController@filter');
        Route::get('/movies', 'api\MovieController@sort'); // sorting
    });
});
