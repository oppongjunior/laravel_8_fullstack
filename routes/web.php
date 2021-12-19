<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontEndPagesController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ContactMessages;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
//email verification
/*
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
*/

//Frontend pages route
//home page route
Route::get('/', [FrontEndPagesController::class, "Home"]);
//contact
Route::get("/contact",[FrontEndPagesController::class, "contact"]);

///Route::get("/about",[AboutController::class, "index"])->middleware("age");

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    $clients = Brand::all();
    $contacts = ContactMessages::all();
    $portfolio = Portfolio::all();
    $services = Service::all();
    $sliders = Slider::all();

    //$users = DB::table("users")->get();
    return view('admin.index',['users'=>$users,'clients'=>$clients,'sliders'=>$sliders,'services'=>$services,'portfolio'=>$portfolio,"messages"=>$contacts]);
})->name('dashboard');

//user route
Route::get("user/all",[UserController::class,"index"]);
Route::get("user/add",[UserController::class,"create"])->name("add.user");
Route::post("user/store",[UserController::class,"store"])->name("store.user");
Route::get("user/delete/{id}",[UserController::class,"destroy"]);

///category routes
Route::get("category/all",[CategoryController::class,"index"])->name("all.category");
Route::post("category/add",[CategoryController::class,"store"])->name("store.category");
Route::get("category/edit/{id}",[CategoryController::class,"edit"]);
Route::post("category/update/{id}",[CategoryController::class,"update"]);
Route::get("category/softdelete/{id}",[CategoryController::class,"softDelete"]);
Route::get("category/restore/{id}",[CategoryController::class,"restore"]);
Route::get("category/pdelete/{id}",[CategoryController::class,"P_Delete"]);

//brand routes
Route::get("brand/all",[BrandController::class,"index"])->name("all.brands");
Route::post("brand/add",[BrandController::class,"store"])->name("store.brand");
Route::get("brand/edit/{id}",[BrandController::class,"edit"]);
Route::post("brand/update/{id}",[BrandController::class,"update"]);
Route::get("brand/softdelete/{id}",[BrandController::class,"softDelete"]);
Route::get("brand/restore/{id}",[BrandController::class,"restore"]);
Route::get("brand/pdelete/{id}",[BrandController::class,"destroy"]);

//multipics routes
Route::get("multi/image",[BrandController::class,"mulitipic"])->name("multi.image");
Route::post("images/add",[BrandController::class,"storeImages"])->name("store.images");

//slider routes
Route::get("slider/all",[SliderController::class,"index"])->name("all.slider");
Route::get("slider/create",[SliderController::class,"create"])->name("add.slider");
Route::post("slider/add",[SliderController::class,"store"])->name("store.slider");
Route::get("slider/edit/{id}",[SliderController::class,"edit"]);
Route::post("slider/update/{id}",[SliderController::class,"update"]);
Route::get("slider/delete/{id}",[SliderController::class,"destroy"]);

//admin about route
Route::get("admin/about",[AboutController::class,"index"])->name("admin.about");
Route::get("about/create",[AboutController::class,"create"])->name("add.about");
Route::post("about/add",[AboutController::class,"store"])->name("store.about");
Route::get("about/edit/{id}",[AboutController::class,"edit"]);
Route::post("about/update/{id}",[AboutController::class,"update"]);
Route::get("about/delete/{id}",[AboutController::class,"destroy"]);

//admin service route
Route::get("service/all",[ServiceController::class,"index"])->name("admin.service");
Route::get("service/create",[ServiceController::class,"create"])->name("add.service");
Route::post("service/add",[ServiceController::class,"store"])->name("store.service");
Route::get("service/edit/{id}",[ServiceController::class,"edit"]);
Route::post("service/update/{id}",[ServiceController::class,"update"]);
Route::get("service/delete/{id}",[ServiceController::class,"destroy"]);

//admin portolio route
Route::get("portfolio/all",[PortfolioController::class,"index"])->name("admin.portfolio");
Route::get("portfolio/create",[PortfolioController::class,"create"])->name("add.portfolio");
Route::post("portfolio/add",[PortfolioController::class,"store"])->name("store.portfolio");
Route::get("portfolio/edit/{id}",[PortfolioController::class,"edit"]);
Route::post("portfolio/update/{id}",[PortfolioController::class,"update"]);
Route::get("portfolio/delete/{id}",[PortfolioController::class,"destroy"]);

//contact message route
Route::get("contact/messages",[ContactController::class,"index"])->name("contact.messages")->middleware('auth');
Route::post("contact/store",[ContactController::class,"store"]);
Route::get("contact/delete/{id}",[ContactController::class,"destroy"]);

//user logout customize
Route::get("user/logout",function(){
    Auth::logout();
    return redirect()->route('login')->with("success","logout successfully");
})->name("user.logout");
