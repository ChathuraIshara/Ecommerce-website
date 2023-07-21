<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

Route::get('/index', [HomeController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admincategory', [adminController::class, 'adminCategory'])->name('category');
    Route::post('/addcategory', [adminController::class, 'addCategory']);
    Route::get('/categorydelete/{id}', [adminController::class, 'categoryDelete']);
    Route::get('/addproduct', [adminController::class, 'addProduct'])->name('addproduct');
    Route::post('/saveproduct', [adminController::class, 'saveProduct']);
    Route::get('/showproduct', [adminController::class, 'showProduct'])->name('showproduct');
    Route::get('/deleteproduct/{id}', [adminController::class, 'deleteProduct']);
    Route::get('/editproduct/{id}', [adminController::class, 'editProductPage']);
    Route::get('/canceledit', [adminController::class, 'cancelEdit']);
    Route::post('/editstore', [adminController::class, 'editStore']);
    Route::get('/deliverdstatus/{id}', [adminController::class, 'deliveredStatus']);
    Route::get('/printpdf/{id}', [adminController::class, 'printPdf']);
    Route::get('/sendmail/{id}', [adminController::class, 'sendMail']);
    Route::post('/senduseremail', [adminController::class, 'sendUserEmail']);
    Route::post('/search', [adminController::class, 'searchOrder']);

    Route::get('/logout', [HomeController::class, 'logOut']);
    Route::get('/productdetails/{id}', [HomeController::class, 'moreDetails']);
    Route::post('/addtocart', [HomeController::class, 'addToCart']);
    Route::get('/cart_page', [HomeController::class, 'showCart']);
    Route::get('/removecartproduct/{id}', [HomeController::class, 'removeCartProduct']);
    Route::get('/cash_order', [HomeController::class, 'cashOrder']);
    Route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);
    Route::post('stripe', [HomeController::class, 'stripePost'])->name('stripe.post');
    Route::get('/order', [adminController::class, 'orderPage']);
    Route::get('/customer_order', [HomeController::class, 'order_page']);
    Route::get('/cancelorder/{id}', [HomeController::class, 'cancelOrder']);
    Route::post('/addcomment', [HomeController::class, 'addComment']);
    Route::post('/addreply', [HomeController::class, 'addReply']);
    Route::post('/searchproduct', [HomeController::class, 'searchProduct']);
    Route::get('/productpage', [HomeController::class, 'productPage']);
    Route::post('/searchproductpage', [HomeController::class, 'searchProductPage']);
});
