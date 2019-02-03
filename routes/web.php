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


/*Route::post();
Route::any();
Route::resource();
Route::group();*/
//Route::get('user/create','UserController@create')->name('createUser');


Route::group(['public'],function (){

    Route::group(['Error'], function () {
        Route::get('error/{code?}', 'ErrorController@error')->name('error');
    });

    Route::group(['Home'], function () {
        Route::get('/','HomeController@index');
        Route::get('home', 'HomeController@index')->name('home');
        Route::post('filterPosts', ['uses' => 'HomeController@filterPosts', 'as' => 'filterPosts']);
        Route::post('searchViaCategory', ['uses' => 'HomeController@searchViaCategory', 'as' => 'searchViaCategory' ]);
    });

    Route::group(['Users'], function () {
        Route::resource('users',"UserController");

        /*Route::get('users.index',"UserController@index")->name('users.index');
        Route::get('users.create',"UserController@create")->name('users.create');
        Route::get('users.edit/{id}',"UserController@edit")->name('users.edit');
        Route::post('users.store',"UserController@store")->name('users.store');
        Route::post('users.update/{id}',"UserController@update")->name('users.update');
        Route::get('users.show/{id}',"UserController@show")->name('users.show');
        Route::get('users.destroy/{id}',"UserController@destroy")->name('users.destroy');*/

        Route::get('test/{id?}',['as' => 'test', 'uses' => "UserController@test"]);
        Route::any('uploadProfilePic', array('as' => 'uploadProfilePic', 'uses' => 'UsersController@uploadProfilePic'));
    });

    Route::group(['Posts'], function () {
        Route::post('/results', ['uses' => 'HomeController@searchPosts', 'as' => 'results' ]);
        Route::get('/show/{post_id}', ['uses' => 'PostController@show', 'as' => 'posts.show']);
    });

    Route::group(['Testing'], function () {
        Route::get('/testing/index', ['uses' => 'TestingController@index', 'as' => 'testingIndex' ]);
        Route::get('/testing/create', ['uses' => 'TestingController@create', 'as' => 'testingCreate' ]);
        Route::get('/testing/edit/{id}', ['uses' => 'TestingController@edit', 'as' => 'testingEdit' ]);
        Route::post('/testing/save-testing-user', ['uses' => 'TestingController@saveTestingUser', 'as' => 'saveTestingUser' ]);
    });
});

Route::group(['private', "middleware" => 'auth'],function (){

    Route::group(['Posts'], function () {
        Route::resource('posts',"PostController");
        Route::post('/like', ['uses' => 'PostController@postLikePost', 'as' => 'like']);
        Route::get('/show/{post_id}', ['uses' => 'PostController@show', 'as' => 'show']);
    });

    Route::group(['Categories'], function () {
        Route::resource('categories',"CategoryController");
        Route::post('/createcategory', ['uses' => 'CategoryController@createCategory', 'as' => 'createcategory', ]);
        Route::get('/delete_category/{id}', ['uses' => 'CategoryController@destroy_cat', 'as' => 'delete_category']);
        Route::get('/editCategory/{id}', ['uses' => 'CategoryController@edit', 'as' => 'editCategory']);
        Route::put('/updateCategory/{id}', ['uses' => 'CategoryController@update_cat', 'as' => 'updateCategory']);
    });
});

/*Route::get('test',function(){
    $post = new Post();
    $formData['conent'] = "sdadasdsadasdsa";
    $formData['abc'] = "sdas";
    $post->savePost($formData);
})->name('test');*/

Auth::routes();

Route::get('abc',function (){
    echo '<a href="'. route('createUser').'">Click Here</a>';
});