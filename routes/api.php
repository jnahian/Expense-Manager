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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::get('income', 'IncomeController@index');
    Route::get('income/{income}', 'IncomeController@details');
    Route::post('income', 'IncomeController@save');
    Route::put('income/{income}', 'IncomeController@update');
    Route::delete('income/{income}', 'IncomeController@delete');

    Route::group(['prefix' => 'account'], function () {
        Route::get('types', 'AccountController@accountTypes')->name('account.types');

        Route::get('', 'AccountController@index');
        Route::get('{account}', 'AccountController@details');
        Route::post('', 'AccountController@save');
        Route::put('{account}', 'AccountController@update');
        Route::delete('{account}', 'AccountController@delete');
    });

    Route::group(['prefix' => 'transaction'], function () {
        Route::get('meta', 'TransactionController@transactionMeta')->name('transaction.meta');

        Route::get('', 'TransactionController@index');
        Route::get('{transaction}', 'TransactionController@details');
        Route::post('', 'TransactionController@save');
        Route::put('{transaction}', 'TransactionController@update');
        Route::delete('{transaction}', 'TransactionController@delete');
    });
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
