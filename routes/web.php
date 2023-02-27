<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\brandcontroller;
use App\Http\Controllers\clientController;
use App\Http\Controllers\GoogleLogin;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\productController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\staffdocController;
use App\Http\Controllers\staticController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware'=>'islogin'],function(){
    //BRANDS 

    Route::post('/brands',[brandcontroller::class,'insert'])->name('insert'); //insert 
    Route::get('/select',[brandcontroller::class,'select'])->name('select'); // select
    Route::get('brandsil/{id}',[brandcontroller::class,'sil'])->name('sil'); //sil he
    Route::get('branddelete/{id}',[brandcontroller::class,'delete'])->name('delete'); // sil
    Route::get('brandedit/{id}',[brandcontroller::class,'edit'])->name('edit');
    Route::post('brandupdate',[brandcontroller::class,'update'])->name('update');
    Route::post('/search',[brandcontroller::class,'search'])->name('search'); // select
    //----------------------------------------CLIENTS--------------------------------------------------//

    Route::post('/clients',[clientController::class,'insert'])->name('clinsert'); //insert 
    Route::get('/cselect',[clientController::class,'select'])->name('cselect'); // select
    Route::get('clientsil/{id}',[clientController::class,'sil'])->name('csil'); //sil he
    Route::get('clientsdel/{id}',[clientController::class,'delete'])->name('cdelete'); // sil
    Route::get('clientsedit/{id}',[clientController::class,'edit'])->name('cedit');
    Route::post('clientsupdate',[clientController::class,'update'])->name('cupdate');
    Route::post('/csearch',[clientController::class,'search'])->name('csearch'); // select

    //------------------------------------------PRODUCT--------------------------------------------------------//

    Route::post('/pinsert',[productController::class,'insert'])->name('pinsert'); //insert 
    Route::get('/pselect',[productController::class,'select'])->name('pselect'); // select
    Route::get('psil/{id}',[productController::class,'sil'])->name('psil'); //sil he
    Route::get('pdelete/{id}',[productController::class,'delete'])->name('pdelete'); // sil
    Route::get('pedit/{id}',[productController::class,'edit'])->name('pedit');
    Route::post('pupdate',[productController::class,'update'])->name('pupdate');
    Route::post('/psearch',[productController::class,'search'])->name('psearch'); // select



    //------------------------------------------ORDERS-----------------------------------------------------------//

    Route::post('/',[ordersController::class,'insert'])->name('orinsert'); //insert 
    Route::get('/',[ordersController::class,'select'])->name('orselect'); // select
    Route::get('orsil/{id}',[ordersController::class,'sil'])->name('orsil'); //sil he
    Route::get('ordelete/{id}',[ordersController::class,'delete'])->name('ordelete'); // sil
    Route::get('oredit/{id}',[ordersController::class,'edit'])->name('oredit');
    Route::post('orupdate',[ordersController::class,'update'])->name('orupdate');
    Route::get('tesdiq/{id}',[ordersController::class,'tesdiq'])->name('tesdiq');
    Route::get('legv/{id}',[ordersController::class,'legv'])->name('legv');
    Route::post('/osearch',[ordersController::class,'search'])->name('osearch'); // select

    
    //------------------------------------------PROFILE-------------------------------//

    Route::get('/myprofile',[profileController::class,'index'])->name('myprofile');
    Route::post('/profile',[profileController::class,'profile'])->name('profile');
    Route::get('/profilsil/{id}',[profileController::class,'sil'])->name('profilsil'); //sil he
    Route::post('/profildel',[profileController::class,'delete'])->name('profildelete'); // sil
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

    Route::post('/isci',[staffController::class,'insert'])->name('isinsert'); //insert 
    Route::get('/iscisel',[staffController::class,'select'])->name('isselect'); // select
    Route::get('iscisil/{id}',[staffController::class,'sil'])->name('issil'); //sil he
    Route::get('iscidelete/{id}',[staffController::class,'delete'])->name('isdelete'); // sil
    Route::get('isciedit/{id}',[staffController::class,'edit'])->name('isedit');
    Route::post('isciupdate',[staffController::class,'update'])->name('isupdate');


    //----------------------------------STAFFDOC----------------------------------//

    Route::post('/doc',[staffdocController::class,'insert'])->name('docinsert'); //insert 
    Route::get('/docsel/{id}',[staffdocController::class,'select'])->name('docselect'); // select
    Route::get('docsil/{id}',[staffdocController::class,'sil'])->name('docsil'); //sil he
    Route::get('docdelete/{id}',[staffdocController::class,'delete'])->name('docdelete'); // sil
    Route::get('docedit/{id}',[staffdocController::class,'edit'])->name('docedit');
    Route::post('docupdate',[staffdocController::class,'update'])->name('docupdate');

    Route::get('/static',[staticController::class,'hesab'])->name('hesabla');


    //--------------------------------------LOGOOUT-----------------------------------------//

    Route::get('/logout',  [userController::class, 'logout'])->name('logout');



});



Route::group(['middleware'=>'notlogin'],function(){


    //------------------------------------------LOGIN--------------------------------------//

Route::post('/login',[userController::class,'login'])->name('login');

Route::get('/login', function(){
    return view('login');
})->name('daxilol');


//----------------------------REGISTER--------------------------------------------//

Route::post('/qeydiyyat',[userController::class,'register'])->name('register');

Route::get('/test',[userController::class,'test'])->name('test');
Route::get('/user-verification/{verification}',[userController::class,'user_verification'])->name('user_verification');



Route::get('/qeydiyyat', function(){
    return view('register');
})->name('qeydiyyat');


Route::get('google',function(){
    return view('googleAuth');
    });

Route::get('auth/google', [GoogleLogin::class,'redirectToGoogle']);

Route::get('auth/google/callback', [GoogleLogin::class,'handleGoogleCallback']);
});
