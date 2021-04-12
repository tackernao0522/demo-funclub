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
Route::get('admin', 'AdminController@index')->name('admin');
Route::get('/', 'TopController@index');
Route::get('news', 'ArticleController@index')->name('articles.index');
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
