<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users as user;
use App\Http\Controllers\admin_controller;
use App\Http\Controllers\mailExample;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[user::class,'home']);
Route::view('/loginUser','User.login');
Route::post('/loginUser',[user::class,'login_auth'])->name('loginUser');

Route::view('/SignUp','User.signup');
Route::post('/SignUp',[user::class,'create_user'])->name('SignUp');

Route::get('/logout',[user::class,'logout']);
Route::view('/about','User.about');
Route::view('/contact','User.contact');
Route::post('/contact',[user::class,'contact'])->name('contact');

Route::view('view_more_product','User.view_more_product');
Route::get('User/view_more_product/{id}',[user::class,'view_more_product']);
Route::get('/order/{id}',[user::class,'order_product']);

Route::view("/forget_password",'User.forget_password');
Route::post('/forget_password',[user::class,'forget_password_1'])->name('forget_password');
Route::get('/sendMail',[user::class,'sendMail']);

#-----------------------------------------------------------

Route::view('Admin_SignUp','admin.pages.signup');
Route::post('Admin_SignUp',[admin_controller::class,'new_admin'])->name('Admin_SignUp');
Route::view('Admin_Login','admin.pages.login');
Route::post('Admin_Login',[admin_controller::class,'admin_auth'])->name('Admin_Login');

Route::view('/adminPannel','admin.index');
Route::get('/adminPannel',[admin_controller::class,'admin_index']);

Route::view('/alluser','admin.pages.alluser');
Route::get('alluser',[admin_controller::class,'all_user']);

Route::get('/adminPannel/{id}/edit', [admin_controller::class,'edit_user']);
Route::put('/adminPannel/{id}',[admin_controller::class,'update_user'])->name('update_user');


Route::view('brand','admin.pages.brand');
Route::post('/brand',[admin_controller::class,'add_brand'])->name('brand');

Route::view('show_Brand','admin.pages.show_brand');
Route::get('show_Brand',[admin_controller::class,'show_Brand']);

Route::get('/Brand/{id}/edit_brand', [admin_controller::class,'edit_Brand']);
Route::put('/Brand/{id}',[admin_controller::class,'update_Brand'])->name('update_Brand');

Route::get('/Brand_Delete/{id}',[admin_controller::class,'Delete_Brand'])->name('Delete_Brand');
Route::view('/Add_Product','admin.pages.add_product');
Route::get('/Add_Product',[admin_controller::class,'add_product']);
Route::post('/Add_Product',[admin_controller::class,'store_product'])->name('Add_Product');


Route::view('/all_product','admin.pages.all_product');
Route::get('/all_product',[admin_controller::class,'all_product']);

Route::view('/viewmore_product','admin.pages.view_more_product');
Route::get('/viewmore_product/{id}',[admin_controller::class,'viewmore_product']);
Route::get('/edit_product/{id}', [admin_controller::class,'edit_product']);
Route::put('/update_product/{id}',[admin_controller::class,'update_product'])->name('update_product');

Route::get('/delete_product/{id}',[admin_controller::class,'delete_product']);
Route::get('/all_orders',[admin_controller::class,'all_orders']);

Route::view('/all_inquiry','admin.pages.all_inquiry');
Route::get('/all_inquiry',[admin_controller::class,'all_inquiry']);

Route::view('/viewmore_inquiry','admin.pages.viewmore_inquiry');
Route::get('/viewmore_inquiry/{id}',[admin_controller::class,'viewmore_inquiry']);

Route::get('/delete_inquiry/{id}',[admin_controller::class,'delete_inquiry']);
Route::get('/delete_user/{id}',[admin_controller::class,'delete_user']);

Route::get('admin_logout',[admin_controller::class,'logout']);
#-----------------------------------------------------------

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
