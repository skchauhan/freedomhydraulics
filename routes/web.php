<?php

use App\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function( Request $request ) {
    $allUser = App\User::get();
    pre($allUser);
});

Auth::routes(['verify' => true]);
Route::get('/admin', 'HomeController@index')->name('home')->middleware('verified');

Route::post('change-lang', function( Request $request ) {
    $strLang = $request->curt_lang;
    if(!empty($strLang)) {
        $result = session(['cur_lang'=>$strLang]);
    }
});

Route::get('user', function(){
    echo '<h2>User Dashboard</h2>';
});

Route::group(['middleware' => ['auth', 'verified'], 'prefix'=>'admin'], function() {
	Route::resource('news', 'Admin\\NewsController');
    Route::post('change-password', 'Admin\\UsersController@updatePassword');
    Route::get('change-password', 'Admin\\UsersController@changePassword');
	Route::resource('users', 'Admin\\UsersController');
	Route::resource('news-category', 'Admin\\NewsCategoryController');
    Route::resource('pages', 'Admin\\PageController');
    Route::post('delete-setting', 'Admin\\generalSettingsController@deleteSetting');
    Route::post('upload-logo', 'Admin\\generalSettingsController@uploadLogo');
    Route::post('update-setting', 'Admin\\generalSettingsController@updateCreate');
    Route::resource('general-settings', 'Admin\\generalSettingsController');
    Route::resource('slider', 'Admin\\SliderController');
    Route::resource('nav-menu', 'Admin\\NavMenuController');
    Route::resource('product-category', 'Admin\\ProductCategoryController');
    Route::resource('product-tab', 'Admin\\ProductTabController');
    Route::resource('languages', 'Admin\\LanguageController');
    Route::resource('products', 'Admin\\ProductController');
    Route::resource('dealer', 'Admin\\DealerController');
    Route::resource('dealer-category', 'Admin\\DealerCategoryController');
    Route::resource('manage-repair-sheets', 'Admin\\ManageRepairSheetsController');
});