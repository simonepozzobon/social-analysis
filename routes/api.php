<?php

use Illuminate\Http\Request;

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

Route::get('/competitor/{id}', 'PageController@get_competitor');

Route::prefix('facebook')->group(function() {
    Route::post('/save-page-id', 'PageController@save_page_id');
    Route::post('/save-posts', 'PageController@save_posts');
    Route::get('/stats', 'PageController@stats');
});

Route::get('get_fb_token', 'UtilsController@get_fb_token');
Route::post('get_facebook_id', 'UtilsController@get_facebook_id');
