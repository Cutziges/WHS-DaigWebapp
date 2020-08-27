<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * ================================================================
 *                          SLACK APP ROUTES
 * ================================================================
 */

/**
 * ------------------------------------------------------------------
 *                           ACTIVITIES
 * ------------------------------------------------------------------
 */
Route::get('/activity', [
    'uses' => 'ActivityController@getActivity',
    'as' => 'activity.slack'
])->middleware('XSS');;

Route::post('/activity', [
    'uses' => 'ActivityController@createActivity'
])->middleware('XSS');;

/**
 * ------------------------------------------------------------------
 *                         RECOMMENDATIONS
 * ------------------------------------------------------------------
 */
Route::get('/fooddrinks', [
    'uses' => 'RecommendationsController@getFoodDrinks',
])->middleware('XSS');;
