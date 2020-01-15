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

    Route::get('admin/faq', 'Admin\FaqController@index')->name('faq-management');
    Route::get('admin/faq/create', 'Admin\FaqController@createForm')->name('faq-create-management');
    Route::post('admin/faq/create', 'Admin\FaqController@create')->name('faq-create');
    Route::delete('admin/faq', 'Admin\FaqController@delete')->name('faq-destroy');
    Route::put('admin/faq', 'Admin\FaqController@update')->name('faq-update');
    Route::get('admin/faq/edit/{questionId}', 'Admin\FaqController@edit')
        ->where('questionId', '[0-9]+')
        ->name('faq-edit');

    Route::get('admin/faq/category', 'Admin\FaqCategoryController@index')->name('faq-category-management');
    Route::get('admin/faq/category/create', 'Admin\FaqCategoryController@createForm')->name('faq-category-create-management');
    Route::post('admin/faq/category/create', 'Admin\FaqCategoryController@create')->name('faq-category-create');
    Route::delete('admin/faq/category', 'Admin\FaqCategoryController@delete')->name('faq-category-destroy');
    Route::put('admin/faq/category', 'Admin\FaqCategoryController@update')->name('faq-category-update');
    Route::get('admin/faq/category/edit/{categoryId}', 'Admin\FaqCategoryController@edit')
        ->where('categoryId', '[0-9]+')
        ->name('faq-category-edit');

    Route::get('admin/blog', 'Admin\Blog\Controller@index')->name('blog-management');
    Route::get('admin/blog/create', 'Admin\Blog\Controller@createForm')->name('blog-create-management');
    Route::post('admin/blog/create', 'Admin\Blog\Controller@create')->name('blog-create');
    Route::delete('admin/blog', 'Admin\Blog\Controller@delete')->name('blog-destroy');
    Route::put('admin/blog', 'Admin\Blog\Controller@update')->name('blog-update');
    Route::get('admin/blog/edit/{postId}', 'Admin\Blog\Controller@edit')
        ->where('postId', '[0-9]+')
        ->name('blog-edit');

    Route::get('admin/blog/category', 'Admin\Blog\CategoryController@index')->name('blog-category-management');
    Route::get('admin/blog/category/create', 'Admin\Blog\CategoryController@createForm')->name('blog-category-create-management');
    Route::post('admin/blog/category/create', 'Admin\Blog\CategoryController@create')->name('blog-category-create');
    Route::delete('admin/blog/category', 'Admin\Blog\CategoryController@delete')->name('blog-category-destroy');
    Route::put('admin/blog/category', 'Admin\Blog\CategoryController@update')->name('blog-category-update');
    Route::get('admin/blog/category/edit/{categoryId}', 'Admin\Blog\CategoryController@edit')
        ->where('categoryId', '[0-9]+')
        ->name('blog-category-edit');
});
