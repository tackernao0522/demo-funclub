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

// Route::get('/', function () {
//     return view('welcome');
// });

// administrator
Route::get('admin', 'AdminController@index')->name('admin');
Route::get('admin/posts/index', 'Admin\PostController@index')->name('posts.index');
Route::get('artice/post/create', 'Admin\PostController@articleCreateForm')->name('articles.create');
Route::post('artice/post/create', 'Admin\PostController@articleCreate');
Route::get('admin/posts/{category}/index', 'Admin\PostController@categoryShow')->name('categories.show');

// user
Route::get('/', 'TopController@index');
Route::get('news', 'ArticleController@index')->name('articles.index');
Route::get('news/{category}/index', 'ArticleController@categoryNews')->name('news.category');
Route::get('information', 'InformationController@index')->name('informations.index');
Route::get('contact', 'ContactController@contactShowForm')->name('contact.form');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// 決済ボタンを表示するページ
// Route::get('/', 'PaymentsController@index')->name('index');

// Stripeの処理
Route::post('/payment', 'PaymentsController@payment')->name('payment');

// 決済完了ページ
Route::get('/complete', 'PaymentsController@complete')->name('complete');
