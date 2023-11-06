<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BrandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffdocController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware'=>'islogin'],function(){
    //BRANDS 

    Route::post('/brands',[BrandController::class,'insert'])->name('insert'); //insert 
    Route::get('/select',[BrandController::class,'select'])->name('select'); // select
    Route::get('brandsil/{id}',[BrandController::class,'sil'])->name('sil'); //sil he
    Route::get('branddelete/{id}',[BrandController::class,'delete'])->name('delete'); // sil
    Route::get('brandedit/{id}',[BrandController::class,'edit'])->name('edit');
    Route::post('brandupdate',[BrandController::class,'update'])->name('update');
    Route::post('/search',[BrandController::class,'search'])->name('search'); // select
    //----------------------------------------CLIENTS--------------------------------------------------//

    Route::post('/clients',[ClientController::class,'insert'])->name('clinsert'); //insert 
    Route::get('/cselect',[ClientController::class,'select'])->name('cselect'); // select
    Route::get('clientsil/{id}',[ClientController::class,'sil'])->name('csil'); //sil he
    Route::get('clientsdel/{id}',[ClientController::class,'delete'])->name('cdelete'); // sil
    Route::get('clientsedit/{id}',[ClientController::class,'edit'])->name('cedit');
    Route::post('clientsupdate',[ClientController::class,'update'])->name('cupdate');
    Route::post('/csearch',[ClientController::class,'search'])->name('csearch'); // select

    //------------------------------------------PRODUCT--------------------------------------------------------//

    Route::post('/pinsert',[ProductController::class,'insert'])->name('pinsert'); //insert 
    Route::get('/pselect',[ProductController::class,'select'])->name('pselect'); // select
    Route::get('psil/{id}',[ProductController::class,'sil'])->name('psil'); //sil he
    Route::get('pdelete/{id}',[ProductController::class,'delete'])->name('pdelete'); // sil
    Route::get('pedit/{id}',[ProductController::class,'edit'])->name('pedit');
    Route::post('pupdate',[ProductController::class,'update'])->name('pupdate');
    Route::post('/psearch',[ProductController::class,'search'])->name('psearch'); // select



    //------------------------------------------ORDERS-----------------------------------------------------------//

    Route::post('/',[OrdersController::class,'insert'])->name('orinsert'); //insert 
    Route::get('/',[OrdersController::class,'select'])->name('orselect'); // select
    Route::get('orsil/{id}',[OrdersController::class,'sil'])->name('orsil'); //sil he
    Route::get('ordelete/{id}',[OrdersController::class,'delete'])->name('ordelete'); // sil
    Route::get('oredit/{id}',[OrdersController::class,'edit'])->name('oredit');
    Route::post('orupdate',[OrdersController::class,'update'])->name('orupdate');
    Route::get('tesdiq/{id}',[OrdersController::class,'tesdiq'])->name('tesdiq');
    Route::get('legv/{id}',[OrdersController::class,'legv'])->name('legv');
    Route::post('/osearch',[OrdersController::class,'search'])->name('osearch'); // select

    
    //------------------------------------------PROFILE-------------------------------//

    Route::get('/myprofile',[ProfileController::class,'index'])->name('myprofile');
    Route::post('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::get('/profilsil/{id}',[ProfileController::class,'sil'])->name('profilsil'); //sil he
    Route::post('/profildel',[ProfileController::class,'delete'])->name('profildelete'); // sil
        //-----------------------------------------ADMIN----------------------------------//

    Route::post('/admininsert',[adminController::class,'insert'])->name('adinsert');
    Route::get('/adminsel',[adminController::class,'select'])->name('adselect');
    Route::get('adminsil/{id}',[adminController::class,'sil'])->name('adminsil'); //sil he
    Route::get('admindel/{id}',[adminController::class,'delete'])->name('admindel'); // sil
    Route::get('adminedit/{id}',[adminController::class,'edit'])->name('adminedit');
    Route::post('adminupdate',[adminController::class,'update'])->name('adminupdate');
    Route::get('blok/{id}',[adminController::class,'blok'])->name('blok');
    Route::get('noblok/{id}',[adminController::class,'noblok'])->name('noblok');

    //----------------------------------STAFF----------------------------------//

    Route::post('/isci',[StaffController::class,'insert'])->name('isinsert'); //insert 
    Route::get('/iscisel',[StaffController::class,'select'])->name('isselect'); // select
    Route::get('iscisil/{id}',[StaffController::class,'sil'])->name('issil'); //sil he
    Route::get('iscidelete/{id}',[StaffController::class,'delete'])->name('isdelete'); // sil
    Route::get('isciedit/{id}',[StaffController::class,'edit'])->name('isedit');
    Route::post('isciupdate',[StaffController::class,'update'])->name('isupdate');


    //----------------------------------STAFFDOC----------------------------------//

    Route::post('/doc',[StaffdocController::class,'insert'])->name('docinsert'); //insert 
    Route::get('/docsel/{id}',[StaffdocController::class,'select'])->name('docselect'); // select
    Route::get('docsil/{id}',[StaffdocController::class,'sil'])->name('docsil'); //sil he
    Route::get('docdelete/{id}',[StaffdocController::class,'delete'])->name('docdelete'); // sil
    Route::get('docedit/{id}',[StaffdocController::class,'edit'])->name('docedit');
    Route::post('docupdate',[StaffdocController::class,'update'])->name('docupdate');

    Route::get('/static',[StaticController::class,'hesab'])->name('hesabla');


    //--------------------------------------LOGOOUT-----------------------------------------//

    Route::get('/logout',  [UserController::class, 'logout'])->name('logout');



});



Route::group(['middleware'=>'notlogin'],function(){


    //------------------------------------------LOGIN--------------------------------------//

Route::post('/login',[UserController::class,'login'])->name('login');

Route::get('/login', function(){
    return view('login');
})->name('daxilol');


//----------------------------REGISTER--------------------------------------------//

Route::post('/qeydiyyat',[UserController::class,'register'])->name('register');
Route::get('/user-verification/{verification}',[UserController::class,'user_verification'])->name('user_verification');



Route::get('/qeydiyyat', function(){
    return view('register');
})->name('qeydiyyat');



});
