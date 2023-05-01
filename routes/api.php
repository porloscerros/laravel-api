<?php

use App\Http\Controllers\AuthController;
use App\Modules\Accounts\Http\Controllers\AccountController;
use App\Modules\Accounts\Http\Controllers\GroupController as AccountGroupController;
use App\Modules\Categories\Http\Controllers\CategoryController;
use App\Modules\Categories\Http\Controllers\ChildCategoryController;
use App\Modules\Categories\Http\Controllers\GroupController as CategoryGroupController;
use App\Modules\Currencies\Http\Controllers\CryptoController;
use App\Modules\Currencies\Http\Controllers\CurrencyController;
use App\Modules\Transactions\Http\Controllers\TransactionController;
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

/*****************
 * Greetings
 *****************/
Route::get('/', function() {
    return [
        'greetings' => 'Welcome to '.config('app.name').' API',
        'authenticate' => url('login'),
        'current_api_version' => config('app.current_api_version', 1),
    ];
})->name('greetings');

/*****************
 * Authentication
 *****************/
Route::group(['prefix' => 'auth'], function() {
    Route::get('/me', [AuthController::class, 'me'])
        ->name('me')
        ->middleware('auth:sanctum');
});

/*****************
 * API v1
 *****************/
Route::group(['prefix' => 'v1'], function() {

    /*****************
     * Public API
     *****************/

    /*****************
     * Private API
     *****************/
    Route::group(['middleware' => 'auth:sanctum'], function() {

//        Route::apiResource('users', UserController::class)
//            ->only(['index', 'show']);

        Route::apiResource('currencies', CurrencyController::class)
            ->only(['index', 'show']);
        Route::apiResource('cryptos', CryptoController::class)
            ->only(['index', 'show']);


        Route::prefix('accounts')
            ->name('accounts.')
            ->group(function () {
                Route::get('/types', [AccountGroupController::class, 'types'])
                    ->name('types');
                Route::apiResource('groups', AccountGroupController::class)
                    ->only(['index', 'show']);
            });
        Route::apiResource('accounts', AccountController::class);


        Route::prefix('categories')
            ->name('categories.')
            ->group(function () {
                Route::apiResource('groups', CategoryGroupController::class)
                    ->only(['index', 'show']);
                Route::apiResource('childs', ChildCategoryController::class);
            });
        Route::apiResource('categories', CategoryController::class);


        Route::apiResource('transactions', TransactionController::class);
        Route::prefix('transactions')
            ->name("transactions.")
            ->group(function () {
                Route::get('/types', [TransactionController::class, 'types'])
                    ->name('types.index');
                Route::post('/import', [TransactionController::class, 'import'])
                    ->name('import');
            });
    });
});
