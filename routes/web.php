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
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;

Route::group(['public'],function (){

    Route::group(['Home'], function () {
        Route::resource('home',"HomeController");
    });

    Route::group(['Users'], function () {
        Route::resource('users',"UserController");
        Route::get('test/{id?}',['as' => 'test', 'uses' => "UserController@test"]);
        Route::any('uploadProfilePic', array('as' => 'uploadProfilePic', 'uses' => 'UsersController@uploadProfilePic'));
    });

    Route::group(['Posts'], function () {
        Route::post('/results', ['uses' => 'HomeController@searchPosts', 'as' => 'results' ]);
        Route::get('/searchViaCategory/{category_ids?}', ['uses' => 'HomeController@searchViaCategory', 'as' => 'searchViaCategory' ]);
        Route::get('/create', ['uses' => 'PostController@index', 'as' => 'create', ]);
        Route::post('/createpost', ['uses' => 'PostController@postCreatePost', 'as' => 'createpost', ]);
        Route::post('/delete-post/{post_id}', ['uses' => 'PostController@getDeletePost', 'as' => 'post.delete']);
        Route::post('/update-post/{post_id}', ['uses' => 'PostController@update', 'as' => 'post.update']);
        Route::post('/edit', ['uses' => 'PostController@edit', 'as' => 'edit']);
        Route::post('/like', ['uses' => 'PostController@postLikePost', 'as' => 'like']);
        Route::get('/delete', ['uses' => 'PostController@deletePost', 'as' => 'deletePost']);

        Route::get('/create', ['uses' => 'PostController@create', 'as' => 'create', ]);
        Route::get('/delete/{post_id}', ['uses' => 'PostController@delete', 'as' => 'delete']);
        Route::get('/edit/{post_id}', ['uses' => 'PostController@edit', 'as' => 'edit']);
        Route::post('/like', ['uses' => 'PostController@postLikePost', 'as' => 'like']);
        Route::get('/show/{post_id}', ['uses' => 'PostController@show', 'as' => 'show']);


    });

    Route::group(['Categories'], function () {

        Route::get('/category', ['uses' => 'CategoryController@index', 'as' => 'category', ]);
        Route::post('/createcategory', ['uses' => 'CategoryController@createCategory', 'as' => 'createcategory', ]);
        Route::get('/delete_category/{id}', ['uses' => 'CategoryController@destroy_cat', 'as' => 'delete_category']);
        Route::get('/editCategory/{id}', ['uses' => 'CategoryController@edit', 'as' => 'editCategory']);
        Route::put('/updateCategory/{id}', ['uses' => 'CategoryController@update_cat', 'as' => 'updateCategory']);
    });

});

Route::group(['private', "middleware" => 'auth'],function (){
    Route::resource('posts',"PostController");
});
//$route = new Route();
//Route::get('/',['as' => '/', 'uses' => "HomeController@index"]);

Route::get('/','PostController@index');
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('post', function () {
    return view('home.Post');
});

Route::get('/',['as' => '/', 'uses' => "HomeController@index"]);



//Route::get('/', function () {
//    return view('home.index');
//});


Auth::routes();

Route::get('/home', 'PostController@index')->name('home');
