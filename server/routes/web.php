<?php

// Route::get('/', function () {
//     return view('welcome');
// });

// administrator
Route::get('admin', 'AdminController@index')->name('admin');
// Contactリスト
Route::get('/contacts/list', 'AdminController@contactList')->name('contact.list');
// Contact詳細
Route::get('/contacts/edit/{contact}', 'AdminController@contactEditForm')->name('contact.edit');
Route::post('/contacts/edit/{contact}', 'AdminController@EditStatus');
// ニュースページ
Route::get('admin/posts/index', 'Admin\PostController@index')->name('posts.index');
// top_title編集
Route::get('top/edit', 'Admin\TopController@topTitleForm')->name('top.edit_form');
Route::post('top/edit/{top}', 'Admin\TopController@editTopTitle')->name('top.edit');
// 新規News投稿
Route::get('artice/post/create', 'Admin\PostController@articleCreateForm')->name('articles.create');
Route::post('artice/post/create', 'Admin\PostController@articleCreate');
// News編集
Route::get('article/post/edit/{post}', 'Admin\PostController@articleEditForm')->name('articles.edit');
Route::post('article/post/edit/{post}', 'Admin\PostController@editArticle');
// News削除
Route::delete('article/post/{id}', 'Admin\PostController@destroy')->name('articles.destroy');
// カテゴリー別ページ
Route::get('admin/posts/{category}/index', 'Admin\PostController@categoryShow')->name('categories.show');
// サブタイトル更新(サイドバー)
Route::get('sub_title/edit', 'Admin\PostController@subTitleEditForm')->name('subTitle.edit');
Route::post('sub_title/edit/{subTitle}', 'Admin\PostController@editSubTitle')->name('edit');
// Information division
Route::get('admin/info/index', 'Admin\InformationController@index')->name('info.index');
// インフォーメーションヘッダーコンテンツ更新
Route::get('info_header/edit', 'Admin\InformationController@infoHeaderBodyEditForm')->name('info_header.edit');
Route::post('info_header/edit/{headerBody}', 'Admin\InformationController@editInfoHeaderBody')->name('infomation_header.edit');
// BigImage更新
Route::get('main_image/edit', 'Admin\InformationController@infoBigImageForm')->name('big_image.edit');
Route::post('main_image/edit/{bigImage}', 'Admin\InformationController@editInfoBigImage')->name('big_info.edit');
// 新規information投稿
Route::get('info/post/create', 'Admin\InformationController@informationCreateForm')->name('information.create');
Route::post('info/post/create', 'Admin\InformationController@informationCreate');
// SmallImage更新
Route::get('small_image/edit/{smallImage}', 'Admin\InformationController@infoSmallImageForm')->name('small_image.edit');
Route::post('small_image/edit/{smallImage}', 'Admin\InformationController@editInfoSmallImage');
// Info削除
Route::delete('info/post/{id}', 'Admin\InformationController@destroy')->name('info.destroy');

// user
Route::get('/', 'TopController@index')->name('top');
// Newsページ
Route::get('news', 'ArticleController@index')->name('articles.index');
// カテゴリー別ページ
Route::get('news/{category}/index', 'ArticleController@categoryNews')->name('news.category');
// Informationページ
Route::get('information', 'InformationController@index')->name('informations.index');

Route::group(['middleware' => 'auth'], function () {
  // BinInfo詳細
  Route::get('main_info', 'InformationController@bigShow')->name('bigInfo.show');
  // Info詳細
  Route::resource('information', 'InformationController', ['only' => ['show']]);
});

// Contactページ
Route::get('contact', 'ContactController@contactShowForm')->name('contact.form');
// 確認ページ
Route::post('confirm', 'ContactController@confirm')->name('confirm');
// DB登録、メール送信(管理者へ)
Route::post('process', 'ContactController@process')->name('process');
// 完了ページ
Route::get('complete', 'ContactController@complete')->name('complete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// 決済ボタンを表示するページ
// Route::get('/', 'PaymentsController@index')->name('index');

// Stripeの処理
Route::post('/payment', 'PaymentsController@payment')->name('payment');

// 決済完了ページ
// Route::get('/complete', 'PaymentsController@complete')->name('complete');
