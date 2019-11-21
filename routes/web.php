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

use App\Product;
use App\Rubric;
use App\SelectedProduct;
use Illuminate\Support\Facades\Auth;

$type_of_product_list = Rubric::orderBy('order')->get();
$type_of_product = [];
foreach ($type_of_product_list as $item) {
    $type_of_product[] = $item->slug;
}
$type_of_product = implode($type_of_product,'|');


Route::get('/', function () {

    $liked = [];
    $select_products = SelectedProduct::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
    foreach ($select_products as $key => $order) {
        $liked[] = $order->product_id;
    }

    return view('welcome', ['liked' => $liked]);
});

Auth::routes();

Route::post('/order/create', 'HelpController@createOrder')->name('createOrder');

Route::post('/pay/refund', 'HelpController@refund')->name('refund');

Route::get('/pay/success/{id}', 'HelpController@success')->name('testPay');
Route::get('/repay/order/{id}', 'HelpController@orderRePay')->name('testPay');
Route::post('/pay/success/{id}', 'HelpController@success')->name('testPay');

Route::post('/pay/check', 'HelpController@check')->name('testPay');
Route::get('/test/pay', 'HelpController@testPay')->name('testPay');
Route::get('/cart', 'HelpController@cart')->name('cart');
Route::post('/cart/get', 'HelpController@getCart')->name('cart_get');
Route::post('/help/find', 'HelpController@find')->name('find');
Route::get('/admin', 'AdminController@index')->name('admin_index');

Route::get('/admin/brand', 'AdminBrandController@index')->name('admin_brands');
Route::get('/admin/brand/add', 'AdminBrandController@add')->name('admin_brand_add');
Route::put('/admin/brand/add', 'AdminBrandController@create')->name('admin_brand_create');

Route::get('/admin/orders', 'AdminOrderController@index')->name('admin_orders');
Route::get('/admin/order/get_list/{page?}', 'AdminOrderController@getList')->name('admin_order_get_list');
Route::get('/admin/order/get/{id}', 'AdminOrderController@get')->name('admin_order_get');
Route::post('/admin/order/update/{id}', 'AdminOrderController@update')->name('admin_order_update');


Route::get('/admin/brand/edit/{id}', 'AdminBrandController@edit')->name('admin_brand_edit');
Route::get('/admin/brand/get/edit/{id}', 'AdminBrandController@getEdit')->name('admin_brand_get_edit');
Route::post('/admin/brand/save/{id}', 'AdminBrandController@save')->name('admin_brand_save');
Route::delete('/admin/brand/delete/{id}', 'AdminBrandController@delete')->name('admin_brand_delete');

Route::get('/admin/brand/get/{page?}', 'AdminBrandController@getList')->name('admin_brand_get_list');


Route::get('/admin/slider', 'AdminSliderController@index')->name('admin_sliders');
Route::get('/admin/slider/add', 'AdminSliderController@add')->name('admin_slider_add');
Route::put('/admin/slider/add', 'AdminSliderController@create')->name('admin_slider_create');
Route::get('/admin/slider/edit/{id}', 'AdminSliderController@edit')->name('admin_slider_edit');
Route::get('/admin/slider/get/edit/{id}', 'AdminSliderController@getEdit')->name('admin_slider_get_edit');
Route::get('/admin/slider/slide/add/{id}', 'AdminSliderController@addSlide')->name('admin_slider_add_slide');
Route::post('/admin/slider/slide/update/{id}', 'AdminSliderController@updateSlide')->name('admin_slider_update_slide');
Route::post('/admin/slider/save/{id}', 'AdminSliderController@save')->name('admin_slider_save');
Route::delete('/admin/slider/delete/{id}', 'AdminSliderController@delete')->name('admin_slider_delete');
Route::delete('/admin/slider/slide/delete/{id}', 'AdminSliderController@deleteSlide')->name('admin_slider_slide_delete');
Route::get('/admin/slider/get/{page?}', 'AdminSliderController@getList')->name('admin_slider_get_list');


Route::get('/admin/page', 'AdminPageController@index')->name('admin_pages');
Route::get('/admin/page/add', 'AdminPageController@add')->name('admin_page_add');
Route::put('/admin/page/add', 'AdminPageController@create')->name('admin_page_create');

Route::get('/admin/page/edit/{id}', 'AdminPageController@edit')->name('admin_page_edit');
Route::get('/admin/page/get/edit/{id}', 'AdminPageController@getEdit')->name('admin_page_get_edit');
Route::post('/admin/page/save/{id}', 'AdminPageController@save')->name('admin_page_save');
Route::delete('/admin/page/delete/{id}', 'AdminPageController@delete')->name('admin_page_delete');
Route::get('/admin/page/get/{page?}', 'AdminPageController@getList')->name('admin_page_get_list');

Route::get('/admin/rubric', 'AdminRubricController@index')->name('admin_rubric');
Route::get('/admin/rubric/add', 'AdminRubricController@add')->name('admin_rubric_add');
Route::put('/admin/rubric/add', 'AdminRubricController@create')->name('admin_rubric_create');
Route::get('/admin/rubric/edit/{id}', 'AdminRubricController@edit')->name('admin_rubric_edit');
Route::get('/admin/rubric/get/edit/{id}', 'AdminRubricController@getEdit')->name('admin_rubric_get_edit');
Route::post('/admin/rubric/save/{id}', 'AdminRubricController@save')->name('admin_rubric_save');
Route::delete('/admin/rubric/delete/{id}', 'AdminRubricController@delete')->name('admin_rubric_delete');
Route::get('/admin/rubric/get/{rubric?}', 'AdminRubricController@getList')->name('admin_rubric_get_list');


Route::get('/admin/product', 'AdminProductController@index')->name('admin_product');
Route::get('/admin/product/add', 'AdminProductController@add')->name('admin_product_add');
Route::put('/admin/product/add/', 'AdminProductController@create')->name('admin_product_create');

Route::get('/admin/product/edit/{id}', 'AdminProductController@edit')->name('admin_product_edit');
Route::get('/admin/product/get/edit/{id}', 'AdminProductController@getEdit')->name('admin_product_get_edit');
Route::get('/admin/product/get/child_list/{id}', 'AdminProductController@getChildList')->name('admin_product_get_child_list');
Route::get('/admin/product/get/tags/{id}', 'AdminProductController@getTags')->name('admin_product_get_tags');
Route::get('/admin/product/get/images/{id}', 'AdminProductController@getImages')->name('admin_product_get_tags');
Route::post('/admin/product/save/{id}', 'AdminProductController@save')->name('admin_product_save');
Route::post('/admin/product/set_tag', 'AdminProductController@setTag')->name('admin_product_set_tag');

Route::delete('/admin/brand/unset_tag/{id}', 'AdminProductController@unsetTag')->name('admin_product_unset_tag');
Route::delete('/admin/product/delete/{id}', 'AdminProductController@delete')->name('admin_product_delete');

Route::post('/admin/product/get/{method}', 'AdminProductController@getList')->name('admin_product_get_list');
Route::get('/admin/product/{method?}/{page?}', 'AdminProductController@index')->name('admin_product');
Route::post('/admin/user/update/{id}', 'AdminUserController@update')->name('admin_product_get_list');
Route::get('/admin/user/get/{method}/{page}', 'AdminUserController@getList')->name('admin_product_get_list');
Route::get('/admin/user/{method?}/{page?}', 'AdminUserController@index')->name('admin_product');

Route::get('/admin/present', 'AdminPresentController@index')->name('admin_present');
Route::get('/admin/present/add', 'AdminPresentController@add')->name('admin_present_add');
Route::put('/admin/present/add', 'AdminPresentController@create')->name('admin_present_create');
Route::get('/admin/present/edit/{id}', 'AdminPresentController@edit')->name('admin_present_edit');
Route::post('/admin/present/get', 'AdminPresentController@getList')->name('admin_present_get_edit');
Route::get('/admin/present/get/edit/{id}', 'AdminPresentController@getEdit')->name('admin_present_get_edit');
Route::post('/admin/present/save/{id}', 'AdminPresentController@save')->name('admin_present_save');
Route::post('/admin/present/image/upload/{id}', 'AdminPresentController@uploadImage')->name('admin_present_save');


Route::delete('admin/media/delete/{dir}', 'AdminImageController@dirDelete')->name('admin_media_dir_delete');
Route::get('/admin/media/{page?}', 'AdminImageController@index')->name('admin_image_index');
Route::get('/admin/media_list/{page}', 'AdminImageController@mediaList')->name('admin_image_list');
Route::get('/admin/media_list/get/{page}', 'AdminImageController@getMediaList')->name('admin_image_list');
Route::get('/admin/image/get_media/{dir?}', 'AdminImageController@getImages')->name('admin_image_get');
Route::post('/admin/image/upload/{product_id?}', 'AdminImageController@upload')->name('admin_image_upload');
Route::post('/admin/image/clone', 'AdminImageController@clone')->name('admin_image_clone');
Route::post('/admin/brochure/upload/{product_id?}', 'AdminProductController@uploadBrochure')->name('admin_brochure_upload');

Route::post('/admin/upload/image', 'AdminImageController@uploadImage')->name('admin_image');

Route::post('/admin/image/add_dir', 'AdminImageController@addDir')->name('admin_image_add_dir');
Route::get('/admin/image/get_dir/{page?}', 'AdminImageController@getDir')->name('admin_image_get_dir');
Route::delete('/admin/image/delete/{id}', 'AdminImageController@imageDelete')->name('admin_image_delete');


Route::get('/admin/tag', 'AdminTagController@index')->name('admin_tags');
Route::get('/admin/tag/add', 'AdminTagController@add')->name('admin_tag_add');
Route::put('/admin/tag/add', 'AdminTagController@create')->name('admin_tag_create');

Route::get('/admin/tag/edit/{id}', 'AdminTagController@edit')->name('admin_tag_edit');
Route::get('/admin/tag/get/edit/{id}', 'AdminTagController@getEdit')->name('admin_tag_get_edit');
Route::post('/admin/tag/save/{id}', 'AdminTagController@save')->name('admin_tag_save');
Route::delete('/admin/tag/delete/{id}', 'AdminTagController@delete')->name('admin_tag_delete');

Route::get('/admin/tag/get/{page?}', 'AdminTagController@getList')->name('admin_tag_get_list');


Route::post('/admin/find/tag', 'AdminHelpController@findTag');


Route::get('/search', 'ProductController@search')->name('all_brands');
Route::get('/all-brands', 'BrandController@allBrands')->name('all_brands');
Route::get('/product-comparison', 'ProductController@comparison')->name('product_comparison');
Route::get('/product-comparison/get', 'ProductController@comparisonGet')->name('product_comparison_get');
Route::post('/add/to-select', 'ProductController@addToSelect')->name('add_to_select');
Route::get('/profile', 'HomeController@index')->name('profile');
Route::post('/product/get/list_by_tag', 'TagController@getProduct')->name('getProductTag');
Route::post('/product/get/list_by_brand', 'BrandController@getProduct')->name('getProductBrand');
Route::get('/profile/get', 'HomeController@getData')->name('profile');
Route::post('/profile/reset_password', 'HomeController@resetPassword')->name('reset_password');
Route::post('/profile/update', 'HomeController@updateUser')->name('update_user');
Route::post('/product/filter', 'ProductController@filterProduct')->name('filter_product');
Route::get('/massage_chairs', 'ProductController@massageChairs')->name('massage_chairs');
Route::get('/sales', 'ProductController@sales')->name('massage_chairs');
Route::get('/new', 'ProductController@new')->name('massage_chairs');
Route::get('/hit', 'ProductController@hit')->name('massage_chairs');
Route::get('/present', 'ProductController@present')->name('massage_chairs');
Route::get('/massagers', 'ProductController@massagers')->name('massagers');
Route::get('/fitness_equipment', 'ProductController@fitnessQquipment')->name('fitness_equipment');
Route::get('/household_products', 'ProductController@householdProducts')->name('household_products');
Route::get('/news', 'PageController@news')->name('page_news');
Route::get('/{product}/{id}/{color?}', 'ProductController@single')->where('color', '(white|cream|graphite|brown|orange|gray)')->name('product_single');
Route::get('/{rubric}', 'ProductController@otherProducts')->where('rubric', '('.$type_of_product.')')->name('other_rubric');
Route::get('/{page}', 'PageController@index')->name('page_index');
