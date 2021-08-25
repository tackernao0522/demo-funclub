<?php

Route::group(['middleware' => 'auth.very_basic'], function () {
  // administrator
  Route::get('admin', 'AdminController@index')->name('admin');
  // Contactリスト
  Route::get('/contacts/list', 'AdminController@contactList')->name('contact.list');
  // Contactリスト(削除)
  Route::delete('/contacts/list/{id}', 'AdminController@destroy')->name('contacts.destroy');
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
  // Admin Online Shop Dashboard
  Route::get('/admin/dashboard', 'Admin\ShopDashboardController@index')->name('dashboard');
  // Admin All Routes
  Route::get('/admin/profile', 'Admin\AdminProfileController@adminProfile')->name('admin.profile');
  Route::get('/admin/profile/edit', 'Admin\AdminProfileController@adminProfileEdit')->name('admin.profile.edit');
  Route::post('/admin/profile/store', 'Admin\AdminProfileController@adminProfileStore')->name('admin.profile.store');
  Route::get('/admin/change/password', 'Admin\AdminProfileController@adminChangePassword')->name('admin.change.password');
  Route::post('/admin/update/change/password', 'Admin\AdminProfileController@adminUpdateChangePassword')->name('update.change.password');
  // Admin Brand All Routes
  Route::prefix('brand')->group(function () {
    Route::get('/view', 'Admin\BrandController@brandView')->name('all.brand');
    Route::post('/store', 'Admin\BrandController@brandStore')->name('brand.store');
    Route::get('/edit/{id}', 'Admin\BrandController@brandEdit')->name('brand.edit');
    Route::post('/update/{id}', 'Admin\BrandController@brandUpdate')->name('brand.update');
    Route::get('/delete/{id}', 'Admin\BrandController@brandDelete')->name('brand.delete');
  });
  // Admin Category(Shop) All Routes
  Route::prefix('category')->group(function () {
    Route::get('/view', 'Admin\CategoryController@categoryView')->name('all.category');
    Route::post('/store', 'Admin\CategoryController@categoryStore')->name('categoy.store');
    Route::get('/edit/{id}', 'Admin\CategoryController@categoryEdit')->name('category.edit');
    Route::post('/update/{id}', 'Admin\CategoryController@categoryUpdate')->name('category.update');
    Route::get('/delete/{id}', 'Admin\CategoryController@categoryDelete')->name('category.delete');
    // Admin SubCategory All Routes
    Route::get('/sub/view', 'Admin\SubCategoryController@subCategoryView')->name('all.subCategory');
    Route::post('/sub/store', 'Admin\SubCategoryController@subCategoryStore')->name('subCategoy.store');
    Route::get('/sub/edit/{id}', 'Admin\SubCategoryController@subCategoryEdit')->name('subCategory.edit');
    Route::post('/sub/update/{id}', 'Admin\SubCategoryController@subCategoryUpdate')->name('subCategory.update');
    Route::get('/sub/delete/{id}', 'Admin\SubCategoryController@subCategoryDelete')->name('subCategory.delete');
    // Admin SubSubCategory All Routes
    Route::get('/sub/sub/view', 'Admin\SubCategoryController@subSubCategoryView')->name('all.subSubCategory');
    Route::get('/subCategory/ajax/{category_id}', 'Admin\SubCategoryController@getSubCategory');
    Route::get('/sub-subCategory/ajax/{subCategory_id}', 'Admin\SubCategoryController@getSubSubCategory');
    Route::post('/sub/sub/store', 'Admin\SubCategoryController@subSubCategoryStore')->name('subSubCategoy.store');
    Route::get('/sub/sub/edit/{id}', 'Admin\SubCategoryController@subSubCategoryEdit')->name('subSubCategory.edit');
    Route::post('/sub/sub/update/{id}', 'Admin\SubCategoryController@subSubCategoryUpdate')->name('subSubCategory.update');
    Route::get('/sub/sub/delete/{id}', 'Admin\SubCategoryController@subSubCategoryDelete')->name('subSubCategory.delete');
  });
  // Admin Products All Routes
  Route::prefix('product')->group(function () {
    Route::get('/add', 'Admin\ProductController@addProduct')->name('add-product');
    Route::post('/store', 'Admin\ProductController@storeProduct')->name('product-store');
    Route::get('/manage', 'Admin\ProductController@manegeProduct')->name('manage-product');
    Route::get('/edit/{id}', 'Admin\ProductController@productEdit')->name('product.edit');
    Route::post('/data/update', 'Admin\ProductController@productDataUpdate')->name('product-update');
    Route::post('/image/update', 'Admin\ProductController@multiImageUpdate')->name('update-product-image');
    Route::post('/thambnail/update/{id}', 'Admin\ProductController@thambnailImageUpdate')->name('update-product-thambnail');
    Route::get('/multiImg/delete/{id}', 'Admin\ProductController@multiImageDelete')->name('product.multiImg.delete');
    Route::get('/inactive/{id}', 'Admin\ProductController@productInactive')->name('product.inactive');
    Route::get('/active/{id}', 'Admin\ProductController@productActive')->name('product.active');
    Route::get('/delete/{id}', 'Admin\ProductController@productDelete')->name('product.delete');
  });
  // Admin Slider All Routes
  Route::prefix('slider')->group(function () {
    Route::get('/view', 'Admin\SliderController@sliderView')->name('manage-slider');
    Route::post('/store', 'Admin\SliderController@sliderStore')->name('slider.store');
    Route::get('/edit/{id}', 'Admin\SliderController@sliderEdit')->name('slider.edit');
    Route::post('/update/{id}', 'Admin\SliderController@sliderUpdate')->name('slider.update');
    Route::get('/delete/{id}', 'Admin\SliderController@sliderDelete')->name('slider.delete');
    Route::get('/inactive/{id}', 'Admin\SliderController@sliderInactive')->name('slider.inactive');
    Route::get('/active/{id}', 'Admin\SliderController@sliderActive')->name('slider.active');
  });
  // Admin Coupon All Routes
  Route::prefix('coupons')->group(function () {
    Route::get('/view', 'Admin\CouponController@couponView')->name('manage-coupon');
    Route::post('/store', 'Admin\CouponController@couponStore')->name('coupon.store');
    Route::get('/edit/{id}', 'Admin\CouponController@couponEdit')->name('coupon.edit');
    Route::post('/update/{id}', 'Admin\CouponController@couponUpdate')->name('coupon.update');
    Route::get('/delete/{id}', 'Admin\CouponController@couponDelete')->name('coupon.delete');
  });
  // Admin Shipping All Routes
  Route::prefix('shipping')->group(function () {
    // Ship Division
    Route::get('/division/view', 'Admin\ShippingAreaController@divisionView')->name('manage-division');
    Route::post('/division/store', 'Admin\ShippingAreaController@divisionStore')->name('division.store');
    Route::get('/division/edit/{id}', 'Admin\ShippingAreaController@divisionEdit')->name('division.edit');
    Route::post('/division/update/{id}', 'Admin\ShippingAreaController@divisionUpdate')->name('division.update');
    Route::get('/division/delete/{id}', 'Admin\ShippingAreaController@divisionDelete')->name('division.delete');
    // Ship District
    Route::get('/district/view', 'Admin\ShippingAreaController@districtView')->name('manage-district');
    Route::post('/district/store', 'Admin\ShippingAreaController@districtStore')->name('district.store');
    Route::get('/district/edit/{id}', 'Admin\ShippingAreaController@districtEdit')->name('district.edit');
    Route::post('/district/update/{id}', 'Admin\ShippingAreaController@districtUpdate')->name('district.update');
    Route::get('/district/delete/{id}', 'Admin\ShippingAreaController@districtDelete')->name('district.delete');
  });
  // Admin Orders All Routes
  Route::prefix('orders')->group(function () {
    Route::get('/pending/orders', 'Admin\OrderController@pendingOrders')->name('pending-orders');
    Route::get('/pending/orders/details/{order_id}', 'Admin\OrderController@pendingOrdersDetails')->name('pending.order.details');
    Route::get('/confirmed/orders', 'Admin\OrderController@confirmedOrders')->name('confirmed-orders');
    Route::get('/processing/orders', 'Admin\OrderController@processingOrders')->name('processing-orders');
    Route::get('/picked/orders', 'Admin\OrderController@pickedOrders')->name('picked-orders');
    Route::get('/shipped/orders', 'Admin\OrderController@shippedOrders')->name('shipped-orders');
    Route::get('/delivered/orders', 'Admin\OrderController@deliveredOrders')->name('delivered-orders');
    Route::get('/cancel/orders', 'Admin\OrderController@cancelOrders')->name('cancel-orders');
    Route::get('/pending/confirm/{order_id}', 'Admin\OrderController@pendingToConfirm')->name('pending-confirm');
    Route::get('/confirm/processing/{order_id}', 'Admin\OrderController@confirmToProcessing')->name('confirm.processing');
    Route::get('/processing/picked/{order_id}', 'Admin\OrderController@processingToPicked')->name('processing.picked');
    Route::get('/picked/shipped/{order_id}', 'Admin\OrderController@pickedToShipped')->name('picked.shippied');
    Route::get('/shipped/deliverd/{order_id}', 'Admin\OrderController@shippedToDelivered')->name('shipped.delivered');
    Route::get('/invoice/download/{order_id}', 'Admin\OrderController@adminInvoiceDownload')->name('invoice.download');
  });
  // Admin Reports Routes
  Route::prefix('reports')->group(function () {
    Route::get('/view', 'Admin\ReportController@reportView')->name('all-reports');
    Route::post('/search/by/date', 'Admin\ReportController@reportByDate')->name('search-by-date');
    Route::post('/search/by/month', 'Admin\ReportController@reportByMonth')->name('search-by-month');
    Route::post('/search/by/year', 'Admin\ReportController@reportByYear')->name('search-by-year');
  });
  // Admin Get All User Routes
  Route::prefix('alluser')->group(function () {
    Route::get('/view', 'Admin\AdminProfileController@allUsers')->name('all-users');
  });
  // Admin Shop Get All Blog Routes
  Route::prefix('blog')->group(function () {
    Route::get('/category', 'Admin\BlogController@blogCategory')->name('blog.category');
    Route::post('/store', 'Admin\BlogController@blogCategoryStore')->name('blogCategoy.store');
    Route::get('/category/edit/{id}', 'Admin\BlogController@blogCategoryEdit')->name('blog.category.edit');
    Route::post('/category/update/{id}', 'Admin\BlogController@blogCategoryUpdate')->name('blogCategory.update');
    Route::get('/delete/{id}', 'Admin\BlogController@categoryDelete')->name('blogCategory.delete');
    // Admin View Blog Post Routes
    Route::get('/list/post', 'Admin\BlogController@listBlogPost')->name('list.post');
    Route::get('/add/post', 'Admin\BlogController@addBlogPost')->name('add.post');
    Route::post('/post/store', 'Admin\BlogController@blogPostStore')->name('post-store');
  });

  // user
  Route::get('/', 'TopController@index')->name('top');

  Route::group(['middleware' => 'auth'], function () {
    // Newsページ
    Route::get('/news', 'ArticleController@index')->name('articles.index');
    // カテゴリー別ページ
    Route::get('/news/{category}/index', 'ArticleController@categoryNews')->name('news.category');
    // Informationページ
    Route::get('information', 'InformationController@index')->name('informations.index');
    // BinInfo詳細
    Route::get('main_info', 'InformationController@bigShow')->name('bigInfo.show');
    // Info詳細
    Route::resource('information', 'InformationController', ['only' => ['show']]);
    // User All Routes
    Route::get('/user/shop/dashbord', 'User\IndexController@userDashboard')->name('user.dashboard');
    Route::get('/user/profile', 'User\IndexController@userProfile')->name('user.profile');
    Route::post('/user/profile/store', 'User\IndexController@userProfileStore')->name('user.profile.store');
    Route::get('/user/change/password', 'User\IndexController@userChangePassword')->name('change.password');
    Route::post('/user/password/update', 'User\IndexController@userPasswordUpdate')->name('user.password.update');
    // Online Shop Index Page
    Route::get('/shop/index', 'Shop\IndexController@index')->name('shop.index');
    // Online Shop Product Details Page url
    Route::get('/product/details/{id}/{slug}', 'Shop\IndexController@productDetails')->name('product.details');
    // Online Shop Product Tags Page
    Route::get('/product/tag/{tag}', 'Shop\IndexController@tagWiseProduct')->name('tags.page');
    // Shop SubCategory Wise Data
    Route::get('/subCategory/product/{subCat_id}', 'Shop\IndexController@subCatWiseProduct');
    // Shop SubSubCategory Wise Data
    Route::get('/subSubCategory/product/{subSubCat_id}', 'Shop\IndexController@subSubCatWiseProduct');
    // Shop Product View Modal with Ajax
    Route::get('/product/view/modal/{id}', 'Shop\IndexController@productViewAjax');
    // Shop Product Add to Cart Store Data
    Route::post('/cart/data/store/{id}', 'Shop\CartController@addToCart');
    // Get Data from Shop mini cart
    Route::get('/product/mini/cart', 'Shop\CartController@addMiniCart');
    // Remove Shop mini cart
    Route::get('/minicart/product-remove/{rowId}', 'Shop\CartController@removeMiniCart');
    // Add to Wishlist
    Route::post('/add-to-wishlist/{product_id}', 'Shop\CartController@AddToWishlist');
    // Shop Wishlist Page
    Route::prefix('user')->group(function () {
      Route::get('/whishlist', 'User\WishlistController@viewWishlist')->name('wishlist');
      Route::get('/get-wishlist-product', 'User\WishlistController@getWishlistProduct');
      Route::get('/wishlist-remove/{id}', 'User\WishlistController@removeWishlistProduct');
      Route::post('/strip/order', 'User\StripeController@stripeOrder')->name('stripe.order');
      Route::post('/cash/order', 'User\CashController@cashOrder')->name('cash.order');
      Route::get('/my/orders', 'User\AllUserController@myOrders')->name('my.orders');
      Route::get('/order_details/{order_id}', 'User\AllUserController@orderDetails');
      Route::get('/invoice_download/{order_id}', 'User\AllUserController@invoiceDownload');
      Route::post('/return/order/{order_id}', 'User\AllUserController@returnOrder')->name('return.order');
      Route::get('/return/order/list', 'User\AllUserController@returnOrderList')->name('return.order.list');
      Route::get('/cancel/orders', 'User\AllUserController@cancelOrders')->name('cancel.orders');
    });
    // Shop My Cart Page All Routes
    Route::get('/mycart', 'User\CartPageController@myCart')->name('mycart');
    Route::get('/user/get-cart-product', 'User\CartPageController@getCartProduct');
    Route::get('/user/cart-remove/{rowId}', 'User\CartPageController@removeCartProduct');
    Route::get('/cart-increment/{rowId}', 'User\CartPageController@cartIncrement');
    Route::get('/cart-decrement/{rowId}', 'User\CartPageController@cartDecrement');
    // Shop Coupon Option
    Route::post('/coupon-apply', 'Shop\CartController@couponApply');
    Route::get('/coupon-calculation', 'Shop\CartController@couponCalculation');
    Route::get('/coupon-remove', 'Shop\CartController@couponRemove');
    // Shop Checkout Routes
    Route::get('/checkout', 'Shop\CartController@checkoutCreate')->name('checkout');
    Route::get('/district-get/ajax/{division_id}', 'User\CheckoutController@districtGetAjax');
    Route::post('/checkout/store', 'User\CheckoutController@checkoutStore')->name('checkout.store');
    // Shop Blog Show Routes
    Route::get('/shop/blog', 'Shop\ShopHomeController@addBlogPost')->name('shopHome.blog');
    Route::get('/shop/blog/details/{id}', 'Shop\ShopHomeController@detailsBlogPost')->name('blogPost.details');
    Route::get('/shop/blog/category/post/{category_id}', 'Shop\ShopHomeController@shopHomeBlogCatPost');
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

  // Stripeサブスクリプションの処理
  Route::get('/subscription', 'StripeController@subscription')->name('stripe.subscription');
  Route::post('/subscription/afterpay', 'StripeController@afterpay')->name('stripe.afterpay');
  Route::get('/subscription/cancel/{user}', 'StripeController@cancelForm')->name('subscription.cancel');
  Route::post('/subscription/cancel/{user}', 'StripeController@cancelSubscription');
});
