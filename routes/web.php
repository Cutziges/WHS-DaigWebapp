<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/index');

Auth::routes();

Route::get('/index', 'HomeController@index')->name('index');


/**
 * ================================================================
 *                     TIPS & TRICKS ROUTES
 * ================================================================
 */

Route::get('/tips', [
    'uses' => 'TipsController@index',
    'as' => 'tips.index',
])->middleware('XSS');

/**
 * ------------------------------------------------------------------
 *                TIPS & TRICKS - Hardware
 * ------------------------------------------------------------------
 */

Route::get('/tips/show/{category_id}', [
    'uses' => 'TipsController@show',
    'as' => 'tips.show'
])->middleware('XSS');


/**
 * ================================================================
 *                     DOCUMENTATIONS ROUTES
 * ================================================================
 */

/**
 * DOCUMENTATIONS - Index
 */
Route::get('/docs', [
    'uses' => 'DocsController@index',
    'as' => 'docs.index',
])->middleware('XSS');

/**
 * DOCUMENTATIONS - Overview of all documents for choosen category
 */
Route::get('/docs/show/{category_id}', [
    'uses' => 'DocsController@show',
    'as' => 'docs.show'
])->middleware('XSS');


/**
 * ================================================================
 *                       ACTIVITY ROUTES
 * ================================================================
 */

/**
 * ACTIVITY - Index
 */
Route::get('/activity', [
    'uses' => 'ActivityController@index',
    'as' => 'activity.index',
])->middleware('XSS');


/**
 * ================================================================
 *                    RECOMMENDATIONS ROUTES
 * ================================================================
 */

/**
 * RECOMMENDATIONS - Index
 */
Route::get('/recommendations', [
    'uses' => 'RecommendationsController@index',
    'as' => 'recommendations.index',
])->middleware('XSS');

/**
 * RECOMMENDATIONS - Overview of all recommendations for choosen category
 */
Route::get('/recommendations/show/{topic_id}', [
    'uses' => 'RecommendationsController@show',
    'as' => 'recommendations.show',
])->middleware('XSS');


/**
 * ================================================================
 *                      SETTINGS ROUTES
 * ================================================================
 */

/**
 * SETTINGS - Index
 */
Route::get('/settings', [
    'uses' => 'SettingsController@index',
    'as' => 'settings.index',
])->middleware('XSS');


/**
 * ================================================================
 *                         HELP ROUTES
 * ================================================================
 */

/**
 * HELP - Index
 */
Route::get('/help', [
    'uses' => 'HelpController@index',
    'as' => 'help.index',
])->middleware('XSS');


/**
 * ================================================================
 *                         FOOTER ROUTES
 * ================================================================
 */

Route::get('/impressum', [
    'uses' => 'FooterController@impressum',
    'as' => 'impressum',
])->middleware('XSS');

Route::get('/privacy', [
    'uses' => 'FooterController@privacy',
    'as' => 'privacy',
])->middleware('XSS');

Route::get('/terms', [
    'uses' => 'FooterController@terms',
    'as' => 'terms',
])->middleware('XSS');


/**
 * ================================================================
 *                     ADMINISTRATION ROUTES
 * ================================================================
 */

Route::get('/admin/index', [
    'uses' => 'AdminController@index',
    'as' => 'admin.index',
])->middleware('XSS');

/**
 * FOOTER - Admin
 */
Route::get('/admin', [
    'uses' => 'FooterController@admin',
    'as' => 'admin',
])->middleware('XSS');

/**
 * ------------------------------------------------------------------
 *                   MIDDLEWARE - Administrator
 * ------------------------------------------------------------------
 */

Route::get('user', function () {
})->middleware('auth');


/**
 * ------------------------------------------------------------------
 *                             ITEM ROUTES
 * ------------------------------------------------------------------
 */

/**
 *=======                         Create                  ===========
 */
Route::post('/item/create', [
    'uses' => 'ItemController@create',
    'as' => 'item.create'
])->middleware('XSS');

/**
 *=======                         Update                  ===========
 */
Route::post('item/edit/{id}', [
    'uses' => 'ItemController@edit',
    'as' => 'item.edit'
])->middleware('XSS');

/**
 *=======                         Delete                  ===========
 */
Route::delete('/item/delete/{id}', [
    'uses' => 'ItemController@delete',
    'as' => 'item.delete'
])->middleware('XSS');

/**
 *=======                         Read                  ===========
 */
Route::get('/items/', [
    'uses' => 'ItemController@index',
    'as' => 'item.index'
])->middleware('XSS');


/**
 * ------------------------------------------------------------------
 *                         DOCUMENTATION ROUTES
 * ------------------------------------------------------------------
 */

/**
 *=======                       Create                     ===========
 */
Route::post('/admin/docs/create/{id}', [
    'uses' => 'DocsController@create',
    'as' => 'docs.create'
])->middleware('XSS');

/**
 *=======                       Update                      ===========
 */
Route::post('/admin/docs/edit/{id}', [
    'uses' => 'DocsController@edit',
    'as' => 'docs.edit'
])->middleware('XSS');

/**
 *=======                       Delete                      ===========
 */
Route::delete('/admin/docs/delete/{id}', [
    'uses' => 'DocsController@delete',
    'as' => 'docs.delete'
])->middleware('XSS');

/**
 *=======                         Read                  ===========
 */
Route::get('/admin/docs/show/{category_id}', [
    'uses' => 'DocsController@showAdmin',
    'as' => 'docs.showAdmin'
])->middleware('XSS');


/**
 * ------------------------------------------------------------------
 *                       TIPS & TRICKS ROUTES
 * ------------------------------------------------------------------
 */

/**
 *=======                         Create                  ===========
 */
Route::post('/admin/tips/create', [
    'uses' => 'TipsController@create',
    'as' => 'tips.create'
])->middleware('XSS');


/**
 *=======                         Update                  ===========
 */
Route::post('/admin/tips/edit/{id}', [
    'uses' => 'TipsController@edit',
    'as' => 'tips.edit'
])->middleware('XSS');

/**
 *=======                         Delete                  ===========
 */
Route::delete('/admin/tips/delete/{id}', [
    'uses' => 'TipsController@delete',
    'as' => 'tips.delete'
])->middleware('XSS');

/**
 *=======                         Read                  ===========
 */
Route::get('/admin/tips', [
    'uses' => 'TipsController@admin',
    'as' => 'tips.admin'
])->middleware('XSS');


/**
 * ------------------------------------------------------------------
 *                   RECOMMENDATIONS ROUTES
 * ------------------------------------------------------------------
 */

/**
 *=======                         Create                  ===========
 */
Route::post('/admin/recs/create', [
    'uses' => 'RecommendationsController@create',
    'as' => 'recs.create'
])->middleware('XSS');

/**
 *=======                         Update                  ===========
 */
Route::post('/admin/recs/edit/{id}', [
    'uses' => 'RecommendationsController@edit',
    'as' => 'recs.edit'
])->middleware('XSS');

/**
 *=======                         Delete                  ===========
 */
Route::delete('/admin/recs/delete/{id}', [
    'uses' => 'RecommendationsController@delete',
    'as' => 'recs.delete'
])->middleware('XSS');


/**
 *=======                         Read                  ===========
 */
Route::get('/admin/recs', [
    'uses' => 'RecommendationsController@admin',
    'as' => 'recs.admin'
])->middleware('XSS');


/**
 * ------------------------------------------------------------------
 *                           ACTIVITY ROUTES
 * ------------------------------------------------------------------
 */

/**
 *=======                         Create                  ===========
 */
Route::post('/admin/activity/create', [
    'uses' => 'ActivityController@create',
    'as' => 'activity.create'
])->middleware('XSS');

/**
 *=======                         Update                  ===========
 */
Route::post('/admin/activity/edit/{id}', [
    'uses' => 'ActivityController@edit',
    'as' => 'activity.edit'
])->middleware('XSS');

/**
 *=======                         Delete                  ===========
 */
Route::delete('/admin/activity/delete/{id}', [
    'uses' => 'ActivityController@delete',
    'as' => 'activity.delete'
])->middleware('XSS');

/**
 *=======                         Read                  ===========
 */
Route::get('/admin/activity/', [
    'uses' => 'ActivityController@admin',
    'as' => 'activity.admin'
])->middleware('XSS');
