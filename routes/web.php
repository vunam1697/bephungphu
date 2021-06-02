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
Route::get('/', 'IndexController@getHome')->name('home.index');

Route::get('san-pham', 'IndexController@getProducts')->name('home.list.product');

Route::get('tra-gop', 'IndexController@getInstallment')->name('home.installment');

Route::get('san-pham/{slug}', 'IndexController@getSingleProduct')->name('home.single.product');

Route::get('danh-muc/{slug}', 'IndexController@getArchiveProduct')->name('home.archive.product');

Route::get('tim-kiem', 'IndexController@getSearch')->name('home.search');

Route::get('flash-sale', 'IndexController@getFlashSale')->name('home.flash-sale');

Route::get('flash-sale/{slug}', 'IndexController@getFlashSaleByCategory')->name('home.flash-sale.category');


Route::get('thuong-hieu', 'IndexController@getListBrand')->name('home.brand');

Route::get('thuong-hieu/{slug}', 'IndexController@getSingleBrand')->name('home.single.brand');

Route::get('tin-tuc', 'IndexController@getArchiveNews')->name('home.archive-news');

Route::get('tin-tuc/{slug}', 'IndexController@getSingleNews')->name('home.post.single');

Route::get('danh-muc-tin-tuc/{slug}', 'IndexController@getCategoriesNews')->name('home.post.category');

Route::get('gioi-thieu', 'IndexController@getAbout')->name('home.about');

Route::post('post-comment/{idproduct}', 'IndexController@postComment')->name('home.post.comment');

Route::get('vote-star', 'IndexController@getVoteStar')->name('home.get.votestar');


Route::post('post-reply-comment/{idproduct}', 'IndexController@postReplyComment')->name('home.post.reply.comment');

Route::post('add-cart', 'IndexController@postAddCart')->name('home.post-add-cart');

Route::get('get-add-cart', 'IndexController@getAddCart')->name('home.get-add-cart');

Route::get('gio-hang', 'IndexController@getCart')->name('home.cart');

Route::get('remove/{rowID}', 'IndexController@getRemoveCart')->name('home.remove.cart');
Route::get('update-cart', 'IndexController@getUpdateCart')->name('home.update.cart');

Route::get('thanh-toan', 'IndexController@getCheckOut')->name('home.check-out');
Route::get('load-province', 'IndexController@getProvince')->name('home.load.province');
Route::post('thanh-toan', 'IndexController@postCheckOut')->name('home.check-out.post');

Route::get('check-coupon', 'IndexController@getCheckCoupon')->name('home.check.coupon');



Route::get('load-products', 'IndexController@getProductsByAjax')->name('home.load.products.ajax');
Route::get('load-brand', 'IndexController@getBrandAjax')->name('home.load.brand.ajax');
Route::get('load-more-product-brand', 'IndexController@getProductsByBrand')->name('home.load.products.brand.ajax');

Route::get('load-more-product-archive', 'IndexController@getLoadMoreProductsByAjax')->name('home.load.products.archive.ajax');

Route::post('filter-products', 'IndexController@getFilterProductsAjax')->name('home.filterProducts');


Route::get('show-review-post/{id}', 'IndexController@getReviewPost')->name('home.review.post');


Route::get('products/tags/{slug}', 'IndexController@getProductByTags')->name('home.products.tags');

Route::get('blog/tags/{slug}', 'IndexController@getNewsByTags')->name('home.news.tags');


Route::get('th/{category}/{brand}.html', 'IndexController@getProductByCategoryAndBrand')->name('home.products.category.brand');

Route::get('pages/{slug}', 'IndexController@getPagesComboProducts')->name('home.pages.combo.products');


Route::group(['namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {
       	Route::get('/home', 'HomeController@index')->name('backend.home');

        Route::resource('users', 'UserController', ['except' => [
            'show'
        ]]);


        $routes = config('admin.route');

        foreach ($routes as $key => $route) {
            Route::resource($key, ucfirst($key).'Controller', ['except' => ['show']] );
            if($route['multi_del'] == true){
                Route::post( $key.'/postMultiDel', ['as' => $key.'.postMultiDel', 'uses' => ucfirst($key).'Controller@deleteMuti']);
            }
        }

        Route::get('products/get-slug', 'ProductsController@getAjaxSlug')->name('products.get-slug');
        Route::post('products/questions/add', 'ProductsController@postAddQuestions')->name('products.questions.add');
        Route::post('products/questions/edit/{id}', 'ProductsController@postEditQuestions')->name('products.questions.edit');
        Route::delete('products/questions/delete/{id}', 'ProductsController@postDeleteQuestions')->name('products.questions.delete');

        Route::get('comments/show/{id}', 'CommentsController@show')->name('comments.show');
        Route::get('comments-active/', ['as' => 'comments.active', 'uses' => 'CommentsController@getQuickActive']);


        Route::resource('posts', 'PostController', ['except' => ['show']]);
        Route::post('posts/postMultiDel', ['as' => 'posts.postMultiDel', 'uses' => 'PostController@deleteMuti']);
        Route::get('posts/get-slug', 'PostController@getAjaxSlug')->name('posts.get-slug');
        Route::resource('category', 'CategoryController', ['except' => ['show']]);


        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', ['as' => 'pages.list', 'uses' => 'PagesController@getListPages']);
            Route::get('build', ['as' => 'pages.build', 'uses' => 'PagesController@getBuildPages']);
            Route::post('build', ['as' => 'pages.build.post', 'uses' => 'PagesController@postBuildPages']);
            Route::post('/create', ['as' => 'pages.create', 'uses' => 'PagesController@postCreatePages']);
        });

        Route::group(['prefix' => 'product-attributes'], function() {
            Route::get('/', 'ProductAttributeTypesController@getList')->name('product-attributes.index');
            Route::post('/store', 'ProductAttributeTypesController@postStore')->name('product-attributes.store');
            Route::get('/{id}/edit', 'ProductAttributeTypesController@getEdit')->name('product-attributes.edit');
            Route::post('/{id}/edit', 'ProductAttributeTypesController@postEdit')->name('product-attributes.post.edit');
            Route::delete('/{id}/delete', 'ProductAttributeTypesController@delete')->name('product-attributes.destroy');
        });


        Route::get('category-filter', 'FilterController@getListCategory')->name('list-category-filter');

        Route::get('sort-filter', 'FilterController@getSort')->name('sort-category-filter');
        Route::post('sort-filter-update', 'FilterController@postSort')->name('sort.filter.update');



        Route::group(['prefix' => 'options'], function() {
            Route::get('/general', 'SettingController@getGeneralConfig')->name('backend.options.general');
            Route::post('/general', 'SettingController@postGeneralConfig')->name('backend.options.general.post');

            Route::get('/dev', 'SettingController@getDeveloperConfig')->name('backend.options.developer-config');
            Route::post('/developer-config', 'SettingController@postDeveloperConfig')->name('backend.options.developer-config.post');

            Route::get('/tags', 'SettingController@getTagsConfig')->name('backend.options.tags');
            Route::post('/tags', 'SettingController@postTagsConfig')->name('backend.options.post.tags');

            

            Route::get('/smtp', 'SettingController@getSmtpConfig')->name('backend.options.smtp-config');
            Route::post('/smtp-config', 'SettingController@postSmtpConfig')->name('backend.options.smtp-config.post');
            Route::post('/send-mail-test', 'SettingController@postSendTestEmail')->name('backend.options.send-mail.post');

        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', ['as' => 'setting.menu', 'uses' => 'MenuController@getListMenu']);
            Route::get('edit/{id}', ['as' => 'backend.config.menu.edit', 'uses' => 'MenuController@getEditMenu']);
            Route::post('add-item/{id}', ['as' => 'setting.menu.addItem', 'uses' => 'MenuController@postAddItem']);
            Route::post('update', ['as' => 'setting.menu.update', 'uses' => 'MenuController@postUpdateMenu']);
            Route::get('delete/{id}', ['as' => 'setting.menu.delete', 'uses' => 'MenuController@getDelete']);
            Route::get('edit-item/{id}', ['as' => 'setting.menu.geteditItem', 'uses' => 'MenuController@getEditItem']);
            Route::post('edit', ['as' => 'setting.menu.editItem', 'uses' => 'MenuController@postEditItem']);
        });

        Route::group(['prefix' => 'menu-category'], function () {
            Route::get('/', ['as' => 'setting.menu-category', 'uses' => 'CategoryMenuController@getList']);
            Route::get('edit/{id}', ['as' => 'setting.menu-category.edit', 'uses' => 'CategoryMenuController@getEditMenu']);
            Route::post('add-item', ['as' => 'setting.menu-category.addItem', 'uses' => 'CategoryMenuController@postAddItem']);
            Route::post('update', ['as' => 'setting.menu-category.update', 'uses' => 'CategoryMenuController@postUpdateMenu']);
            Route::get('delete/{id}', ['as' => 'setting.menu-category.delete', 'uses' => 'CategoryMenuController@getDelete']);

            Route::get('edit-item/{id}', ['as' => 'setting.menu-category.geteditItem', 'uses' => 'CategoryMenuController@getEditItem']);
            Route::post('edit', ['as' => 'setting.menu-category.editItem', 'uses' => 'CategoryMenuController@postEditItem']);


            Route::get('move', ['as' => 'setting.menu-category.move', 'uses' => 'CategoryMenuController@getMoveMenu']);

            Route::post('move', ['as' => 'setting.menu-category.move.post', 'uses' => 'CategoryMenuController@postMoveMenu']);

        });


        Route::group(['prefix' => 'orders'], function() {
            Route::get('/', ['as' => 'order.index', 'uses' => 'OrdersController@getList']);
            Route::get('edit/{id}', ['as' => 'order.edit', 'uses' => 'OrdersController@getEdit']);
            Route::post('edit/{id}', ['as' => 'order.edit.post', 'uses' => 'OrdersController@postEdit']);
            Route::delete('delete/{id}', ['as' => 'order.destroy', 'uses' => 'OrdersController@postDelete']);
            Route::post('delete-multi', ['as' => 'order.postMultiDel', 'uses' => 'OrdersController@deleteMuti']);
        });

        Route::resource('categories-post', 'CategoriesPostController', ['except' => [
            'show','create'
        ]]);

        Route::resource('products-combo', 'ProductPageComboController', ['except' => ['show']]);
        Route::resource('product-gift', 'ProductGiftController', ['except' => ['show']]);

        Route::get('/get-layout', 'HomeController@getLayOut')->name('get.layout');

    });
});

Auth::routes(
    [
        'register' => false,
        'verify' => false,
        'reset' => false,
    ]
);
