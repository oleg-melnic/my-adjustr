<?php

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
//	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group([
    'middleware'    => ['web'],
    'as'            => 'laravelroles::',
//    'namespace'     => 'jeremykenedy\LaravelRoles\App\Http\Controllers',
], function () {

    // Dashboards and CRUD Routes
    Route::resource('roles', 'LaravelRolesController');
    Route::resource('permissions', 'LaravelPermissionsController');

    // Deleted Roles Dashboard and CRUD Routes
    Route::get('roles-deleted', 'LaravelRolesDeletedController@index')->name('roles-deleted');
    Route::get('role-deleted/{id}', 'LaravelRolesDeletedController@show')->name('role-show-deleted');
    Route::put('role-restore/{id}', 'LaravelRolesDeletedController@restoreRole')->name('role-restore');
    Route::post('roles-deleted-restore-all', 'LaravelRolesDeletedController@restoreAllDeletedRoles')->name('roles-deleted-restore-all');
    Route::delete('roles-deleted-destroy-all', 'LaravelRolesDeletedController@destroyAllDeletedRoles')->name('destroy-all-deleted-roles');
    Route::delete('role-destroy/{id}', 'LaravelRolesDeletedController@destroy')->name('role-item-destroy');

    // Deleted Permissions Dashboard and CRUD Routes
    Route::get('permissions-deleted', 'LaravelpermissionsDeletedController@index')->name('permissions-deleted');
    Route::get('permission-deleted/{id}', 'LaravelpermissionsDeletedController@show')->name('permission-show-deleted');
    Route::put('permission-restore/{id}', 'LaravelpermissionsDeletedController@restorePermission')->name('permission-restore');
    Route::post('permissions-deleted-restore-all', 'LaravelpermissionsDeletedController@restoreAllDeletedPermissions')->name('permissions-deleted-restore-all');
    Route::delete('permissions-deleted-destroy-all', 'LaravelpermissionsDeletedController@destroyAllDeletedPermissions')->name('destroy-all-deleted-permissions');
    Route::delete('permission-destroy/{id}', 'LaravelpermissionsDeletedController@destroy')->name('permission-item-destroy');
});

// APP Routes Below
Route::group([
    'middleware' => 'web',
//    'namespace' => 'jeremykenedy\laravelusers\app\Http\Controllers'
], function () {
    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
    ]);
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');
});
