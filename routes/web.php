<?php

use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\BuyPropertyController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\PropertyController;
use App\Http\Controllers\Site\RentPropertyController;
use App\Http\Controllers\Site\SalePropertyController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::group(['middleware'=>'auth'],function (){
    Route::get('/account', [SiteController::class,'viewMyAccountPage'])->name('viewMyAccount');
    Route::get('/sale-property', [PropertyController::class,'viewSaleProperty'])->name('saleProperty');
    Route::post('/save_property', [PropertyController::class,'save_property'])->name('save_property');
    Route::post('album/delete' , [PropertyController::class , 'delete_album'])->name('delete_album');

    Route::get('/update_property/{id}', [PropertyController::class,'update_property'])->name('update_property');
    Route::post('/edit_property', [PropertyController::class,'edit_property'])->name('edit_property');
    Route::post('/securitysettings', [App\Http\Controllers\UserController::class, 'security_settings'])->name('user.settings_security.save');
    Route::post('/location', [App\Http\Controllers\UserController::class, 'location'])->name('user.location.save');
    Route::post('/like', [App\Http\Controllers\LikeController::class, 'like'])->name('property.like');
    Route::get('/wishlist', [SiteController::class,'wishlist'])->name('wishlist');
    Route::post('address/delete' , [App\Http\Controllers\UserController::class , 'delete_address'])->name('delete_address');
    Route::post('order/delete' , [App\Http\Controllers\Site\OrderController::class , 'delete_order'])->name('delete_order');


});
Route::resource('cart', App\Http\Controllers\Site\CartController::class);
Route::get('/order', [App\Http\Controllers\Site\OrderController::class,'index'])->name('indexorder');
Route::post('/order/store', [App\Http\Controllers\Site\OrderController::class,'store'])->name('storeorder');
Route::get('/cartempty', [App\Http\Controllers\Site\OrderController::class,'cartempty'])->name('cartempty');
Route::get('/showorder/{id}', [App\Http\Controllers\Site\OrderController::class,'showorder'])->name('showorder');
Route::get('/showorder2', [App\Http\Controllers\Site\OrderController::class,'showorder2'])->name('showorder2');

Route::post('/discount', [App\Http\Controllers\Site\OrderController::class,'discount'])->name('discount');

Route::post('/mailing', [App\Http\Controllers\MailingController::class, 'mailing'])->name('mailing');
Route::post('/subscriber', [App\Http\Controllers\SubscriberController::class, 'subscriber'])->name('subscriber');

Route::get('search_property', [PropertyController::class, 'search_property'])->name('search_property');
Route::get('searcha_property', [PropertyController::class, 'searcha_property'])->name('searcha_property');
Route::get('/category_property/{id}', [PropertyController::class,'category_property'])->name('category_property');

Route::get('/', [SiteController::class,'viewHomePage'])->name('viewHomePage');
Route::get('/home', [SiteController::class,'viewHomePage'])->name('viewHomePage');
Route::get('/buy-property', [PropertyController::class,'viewBuyProperty'])->name('buyProperty');
Route::get('/rent-property', [PropertyController::class,'viewRentProperty'])->name('rentProperty');
Route::get('/property/{id}', [PropertyController::class,'viewProperty'])->name('viewProperty');
Route::get('/policy-us', [SiteController::class,'policy'])->name('policy');
Route::get('/conditions-us', [SiteController::class,'conditions'])->name('conditions');
Route::get('/questions-us', [SiteController::class,'questions'])->name('questions');
Route::get('/Shipping-us', [SiteController::class,'Shipping'])->name('Shipping');
Route::get('/about-us', [SiteController::class,'viewAboutUs'])->name('about');
Route::get('/contact', [SiteController::class,'viewContact'])->name('viewContact');
Route::post('/contact', [ContactController::class,'storeMessage'])->name('storeMessage');

Route::get('get_cities/{name}', [App\Http\Controllers\Site\PropertyController::class, 'get_cities'])->name('get.cities');

Route::get('payment', [\App\Http\Controllers\MyFatoorahController::class, 'index']);
Route::get('payment/callback', [\App\Http\Controllers\MyFatoorahController::class, 'callback']);
Route::get('payment/error', [\App\Http\Controllers\MyFatoorahController::class, 'error']);

Route::get('qtyproduct', [\App\Http\Controllers\PolicyController::class, 'qtyproduct']);
Route::get('getqtyproduct/{code}', [App\Http\Controllers\PolicyController::class, 'getqtyproduct']);
Route::post('/numberorder', [App\Http\Controllers\Site\OrderController::class,'numberorder'])->name('numberorder');

// Admin Routes
Route::prefix("admin")->group(function () {

    Route::get('login' , [App\Http\Controllers\Admin\AuthController::class , 'login'])->name('admin.login');
    Route::post('login' , [App\Http\Controllers\Admin\AuthController::class , 'dologin'])->name('admin.dologin');

    Route::group(['namespace' => 'Admin', 'middleware' => ['auth:web','is_admin']], function () {
        Route::get('/' , [App\Http\Controllers\Admin\HomeController::class , 'index'])->name('admin.home');
        Route::get('home' , [App\Http\Controllers\Admin\HomeController::class , 'index'])->name('admin.home');
        Route::get('logout' , [App\Http\Controllers\Admin\AuthController::class , 'logout'])->name('admin.logout');
        
        Route::get('contact' , [App\Http\Controllers\Admin\HomeController::class , 'contact'])->name('admin.contact');
        Route::post('contact/delete' , [App\Http\Controllers\Admin\HomeController::class , 'delete_contact'])->name('admin.contact.delete');

      
        //////////////// admins /////////////////
        Route::get('add/admin' , [App\Http\Controllers\Admin\AdminsController::class , 'add'])->name('admin.admin.add');
        Route::get('admin/list' , [App\Http\Controllers\Admin\AdminsController::class , 'admins_list'])->name('admin.admin');
        Route::get('admin/profile/{id}' , [App\Http\Controllers\Admin\AdminsController::class , 'admin_profile'])->name('admin.admin.profile');
        Route::post('admin/save/{id}' , [App\Http\Controllers\Admin\AdminsController::class , 'admin_save'])->name('admin.admin.save');
        Route::post('admin/delete' , [App\Http\Controllers\Admin\AdminsController::class , 'admin_delete'])->name('admin.admin.delete');
        Route::post('admin/store' , [App\Http\Controllers\Admin\AdminsController::class , 'admin_store'])->name('admin.admin.store');
        Route::post('admin/password' , [App\Http\Controllers\Admin\AdminsController::class , 'password'])->name('admin.admin.password');

        
        //////////////// users /////////////////
            Route::get('user/list' , [App\Http\Controllers\Admin\UsersController::class , 'users_list'])->name('admin.user');
            Route::get('user/profile/{id}' , [App\Http\Controllers\Admin\UsersController::class , 'user_profile'])->name('admin.user.profile');
            Route::post('user/save/{id}' , [App\Http\Controllers\Admin\UsersController::class , 'user_save'])->name('admin.user.save');
            Route::post('user/delete' , [App\Http\Controllers\Admin\UsersController::class , 'user_delete'])->name('admin.user.delete');

                
    ////////// settings /////////////////
        Route::get('settings' , [App\Http\Controllers\Admin\SettingController::class , 'index'])->name('settings.index');
        Route::post('/settings/{settings}' , [App\Http\Controllers\Admin\SettingController::class , 'update'])->name('settings.update');
       
        
        //////////////// countries /////////////////
        Route::get('countries/list' , [App\Http\Controllers\Admin\CountryController::class , 'countries_list'])->name('admin.countries');
        Route::get('country/profile/{id}' , [App\Http\Controllers\Admin\CountryController::class , 'country_profile'])->name('admin.country.profile');
        Route::post('country/save' , [App\Http\Controllers\Admin\CountryController::class , 'country_save'])->name('admin.country.save');
        Route::post('country/edit' , [App\Http\Controllers\Admin\CountryController::class , 'country_edit'])->name('admin.country.edit');
        Route::post('city/delete' , [App\Http\Controllers\Admin\CountryController::class , 'delete_city'])->name('delete_city');
        Route::post('country/delete' , [App\Http\Controllers\Admin\CountryController::class , 'delete_country'])->name('admin.country.delete');

        //////////////// categories /////////////////
        Route::get('categories/list' , [App\Http\Controllers\Admin\CategoryController::class , 'categories_list'])->name('admin.categories');
        Route::get('category/profile/{id}' , [App\Http\Controllers\Admin\CategoryController::class , 'category_profile'])->name('admin.category.profile');
        Route::post('category/save' , [App\Http\Controllers\Admin\CategoryController::class , 'category_save'])->name('admin.category.save');
        Route::post('category/edit' , [App\Http\Controllers\Admin\CategoryController::class , 'category_edit'])->name('admin.category.edit');
        Route::post('category/delete' , [App\Http\Controllers\Admin\CategoryController::class , 'delete_category'])->name('delete_category');


        //////////////// types /////////////////
        Route::get('types/list' , [App\Http\Controllers\Admin\TypeController::class , 'types_list'])->name('admin.types');
        Route::get('type/profile/{id}' , [App\Http\Controllers\Admin\TypeController::class , 'type_profile'])->name('admin.type.profile');
        Route::post('type/save' , [App\Http\Controllers\Admin\TypeController::class , 'type_save'])->name('admin.type.save');
        Route::post('type/edit' , [App\Http\Controllers\Admin\TypeController::class , 'type_edit'])->name('admin.type.edit');
        Route::post('type/delete' , [App\Http\Controllers\Admin\TypeController::class , 'delete_type'])->name('delete_type');

        ////////carousel//////
        Route::get('carousels/list' , [App\Http\Controllers\Admin\CarouselController::class , 'carousels_list'])->name('admin.carousels');
        Route::get('carousel/profile/{id}' , [App\Http\Controllers\Admin\CarouselController::class , 'carousel_profile'])->name('admin.carousel.profile');
        Route::post('carousel/save' , [App\Http\Controllers\Admin\CarouselController::class , 'carousel_save'])->name('admin.carousel.save');
        Route::post('carousel/edit' , [App\Http\Controllers\Admin\CarouselController::class , 'carousel_edit'])->name('admin.carousel.edit');
        Route::post('carousel/delete' , [App\Http\Controllers\Admin\CarouselController::class , 'delete_carousel'])->name('delete_carousel');
        ////////discount//////
        Route::get('discounts/list' , [App\Http\Controllers\Admin\DiscountController::class , 'discounts_list'])->name('admin.discounts');
        Route::get('discount/profile/{id}' , [App\Http\Controllers\Admin\DiscountController::class , 'discount_profile'])->name('admin.discount.profile');
        Route::post('discount/save' , [App\Http\Controllers\Admin\DiscountController::class , 'discount_save'])->name('admin.discount.save');
        Route::post('discount/edit' , [App\Http\Controllers\Admin\DiscountController::class , 'discount_edit'])->name('admin.discount.edit');
        Route::post('discount/delete' , [App\Http\Controllers\Admin\DiscountController::class , 'delete_discount'])->name('delete_discount');
    ////////Currency//////
    Route::get('currencies/list' , [App\Http\Controllers\Admin\CurrencyController::class , 'currencies_list'])->name('admin.currencies');
    Route::get('currency/profile/{id}' , [App\Http\Controllers\Admin\CurrencyController::class , 'currency_profile'])->name('admin.currency.profile');
    Route::post('currency/save' , [App\Http\Controllers\Admin\CurrencyController::class , 'currency_save'])->name('admin.currency.save');
    Route::post('currency/edit' , [App\Http\Controllers\Admin\CurrencyController::class , 'currency_edit'])->name('admin.currency.edit');
    Route::post('currency/delete' , [App\Http\Controllers\Admin\CurrencyController::class , 'delete_currency'])->name('delete_currency');


        ////////property//////
        Route::get('properties/list' , [App\Http\Controllers\Admin\PropertyController::class , 'properties_list'])->name('admin.properties');
        Route::get('properties/ajax' , [App\Http\Controllers\Admin\PropertyController::class , 'propertiesajax'])->name('admin.propertiesajax');
        Route::get('property/profile/{id}' , [App\Http\Controllers\Admin\PropertyController::class , 'property_profile'])->name('admin.property.profile');
        Route::post('property/save' , [App\Http\Controllers\Admin\PropertyController::class , 'property_save'])->name('admin.property.save');
        Route::post('property/edit' , [App\Http\Controllers\Admin\PropertyController::class , 'property_edit'])->name('admin.property.edit');
        Route::get('property/delete/{id}' , [App\Http\Controllers\Admin\PropertyController::class , 'delete_property'])->name('admin.property.delete');


        ////////products//////
 Route::get('products/list' , [App\Http\Controllers\Admin\ProductController::class , 'products_list'])->name('admin.products');
 Route::get('products/ajax' , [App\Http\Controllers\Admin\ProductController::class , 'productsajax'])->name('admin.productsajax');
 Route::get('product/profile/{id}' , [App\Http\Controllers\Admin\ProductController::class , 'product_profile'])->name('admin.product.profile');
 Route::post('product/save' , [App\Http\Controllers\Admin\ProductController::class , 'product_save'])->name('admin.product.save');
 Route::post('product/edit' , [App\Http\Controllers\Admin\ProductController::class , 'product_edit'])->name('admin.product.edit');
 Route::get('product/delete/{id}' , [App\Http\Controllers\Admin\ProductController::class , 'delete_product'])->name('admin.product.delete');
 Route::get('add/product' , [App\Http\Controllers\Admin\ProductController::class , 'product_add'])->name('admin.add.product');
 Route::post('product/save' , [App\Http\Controllers\Admin\ProductController::class , 'product_save'])->name('admin.product.save');
 Route::post('color/delete' , [App\Http\Controllers\Admin\ProductController::class , 'delete_color'])->name('delete_color');
 Route::post('option/delete' , [App\Http\Controllers\Admin\ProductController::class , 'delete_option'])->name('delete_option');
 Route::post('editqty' , [App\Http\Controllers\Admin\ProductController::class , 'editqty'])->name('editqty');


 Route::get('orders/list' , [App\Http\Controllers\Admin\OrderController::class , 'orders_list'])->name('admin.orders');
 Route::get('order/profile/{id}' , [App\Http\Controllers\Admin\OrderController::class , 'order_profile'])->name('admin.order.profile');
 Route::get('order/shipping/{id}' , [App\Http\Controllers\Admin\OrderController::class , 'shipping'])->name('admin.order.shipping');
 Route::get('sh/orders/list' , [App\Http\Controllers\Admin\OrderController::class , 'sh_orders_list'])->name('sh.admin.orders');




    });

});