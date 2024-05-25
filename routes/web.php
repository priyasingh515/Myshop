<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\loginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Http\Request;




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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=>'admin.guest'],function(){
        
        Route::get('/login',[loginController::class,'index'])->name('admin.login');
        Route::post('/authenticate',[loginController::class,'authenticate'])->name('admin.authenticate');

    });

    Route::group(['middleware'=>'admin.auth'],function(){

        Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');

            //Category Route
        Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
        Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');

        Route::get('/getslug',function(Request $request){
                $slug = '';
            if(!empty($request->title)){

                $slug =Str::slug($request->title);

            }
            return response()->json([
                'status'=>true,
                'slug'=>$slug
            ]);

        })->name('getslug');


    });


});