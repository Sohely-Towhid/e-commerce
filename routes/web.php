<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubcatagoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerAccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerLoginnController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;



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
//frontend
Route::get('/',[FrontendController::class,'index'])->name('index');
Route::get('/product/details/{product_id}',[FrontendController::class,'product_details'])->name('product.details');
Route::post('/getSize',[FrontendController::class,'getSize']);

Route::get('/about',[HomeController::class,'about']);
Route::get('/contact',[HomeController::class,'contact']);
Route::get('/home',[HomeController::class,'home'])->name('home');

//users//
Route::get('/user/delete/{user_id}',[HomeController::class,'delete'])->name('del');

//catagory//

Route::get('/catagory',[CatagoryController::class,'index'])->name('catagory.index');
Route::post('/catagory/insert',[CatagoryController::class,'insert'])->name('catagory.insert');
Route::get('/catagory/edit/{catagory_id}',[CatagoryController::class,'edit'])->name('catagory.edit');
Route::post('/catagory/update',[CatagoryController::class,'update'])->name('catagory.update');
Route::get('/catagory/restore/{catagory_id}',[CatagoryController::class,'restore'])->name('catagory.restore');
Route::get('/catagory/force_delete/{catagory_id}',[CatagoryController::class,'force_delete'])->name('catagory.force_delete');
Route::post('/mark/delete',[CatagoryController::class,'markdel'])->name('catagory.markdel');
Route::get('/catagory/delete/{catagory_id}',[CatagoryController::class,'delete'])->name('catagory.delete');
Auth::routes();

//subcatagory//
Route::get('/subcatagory',[SubcatagoryController::class,'index'])->name('subcatagory.index');
Route::post('/subcatagory/insert',[SubcatagoryController::class,'insert'])->name('subcatagory.insert');
Route::get('/subcatagory/delete/{subcatagory_id}',[SubcatagoryController::class,'delete'])->name('subcatagory.delete');

//dashboard//
Route::get('/dashboard',[HomeController::class,'dashboard']);

//profile//

Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
Route::post('/name/change',[ProfileController::class,'name_change'])->name('name.change');
Route::post('/password/change',[ProfileController::class,'password_change'])->name('password.change');
Route::post('/photo/change',[ProfileController::class,'photo_change'])->name('photo.change');


//products//

Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::post('/getCatagory',[ProductController::class,'getCatagory']);
Route::post('/product/insert',[ProductController::class,'insert']);
Route::get('/color',[InventoryController::class,'color'])->name('color');
Route::post('/color/insert',[InventoryController::class,'insert']);
Route::get('/size',[InventoryController::class,'size'])->name('size');
Route::post('/size/insert',[InventoryController::class,'size_insert']);
Route::get('/inventory/{product_id}',[InventoryController::class,'inventory'])->name('inventory');
Route::post('/inventory/insert',[InventoryController::class,'inventory_insert']);

//customer//
Route::get('/customer/register/from',[CustomerRegisterController::class,'customer_register_from'])->name('customer.register.from');
Route::post('/customer/register',[CustomerRegisterController::class,'customer_register']);

Route::post('/customer/login',[CustomerLoginnController::class,'customer_login']);
Route::post('/customer/update',[CustomerAccountController::class,'customer_update'])->name('customer.update');
Route::get('/customer/account',[CustomerAccountController::class,'customer_account'])->name('account');
Route::get('/customer/logout',[CustomerAccountController::class,'customerlogout'])->name('customerlogout');


//cart//

Route::post('/cart/insert',[CartController::class,'cart_insert']);
Route::get('/cart/delete/{cart_id}',[CartController::class,'cart_delete'])->name('cart.delete');
Route::get('/cart',[CartController::class,'cart'])->name('cart');
Route::post('/cart/update',[CartController::class,'cart_update']);

//coupon//
Route::get('/coupon',[CouponController::class,'coupon'])->name('coupon');
Route::post('/coupon/insert',[CouponController::class,'coupon_insert']);

//Checkout//
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getCity',[CheckoutController::class,'getCity']);
Route::post('/order/placed',[CheckoutController::class,'order_insert']);
Route::get('/order/confirmed',[CheckoutController::class,'order_confirmed'])->name('order.confirmed');






// SSLCOMMERZ Start

Route::get('/sslpay', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//stripe//

Route::get('stripe', [StripePaymentController::class, 'stripe']);

Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

//invoice//

Route::get('/invoice/download/{invoice_id}',[CustomerAccountController::class,'invoice'])->name('invoice.download');



//customer password reset//

Route::get('/customer/pass/reset/req', [CustomerAccountController::class, 'password_reset_req'])->name('password.reset.req');
Route::post('/customer/pass/reset/store', [CustomerAccountController::class, 'password_reset_store'])->name('password.reset.store');













