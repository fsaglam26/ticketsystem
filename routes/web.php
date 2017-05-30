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


Route::get('/', function () {
    return view('home');
});

Auth::routes();



Route::get('/index', array('as'=>'index','uses'=>'PageController@getIndex'));
Route::get('/adminhome', array('as'=>'adminhome','uses'=>'PageController@getAdminhome'));
Route::get('/userhome', array('as'=>'userhome','uses'=>'PageController@getUserhome'));
Route::get('/yetkiver',array('as'=>'yetkiver','uses'=>'PageController@getYetkiver'));
Route::get('/kategori',array('as'=>'kategori','uses'=>'PageController@getAdminkategori'));
Route::get('/ticketcevapla/{id?}',array('as'=>'ticketcevapla','uses'=>'PageController@getTicketcevapla'));

Route::post('/ara',array('as'=>'ara','uses'=>'SayfaController@postAra'));
Route::post('/kaydet',array('as'=>'kaydet','uses'=>'SayfaController@postKaydet'));
Route::post('/kategoriekle',array('as'=>'kategoriekle','uses'=>'SayfaController@postKategoriekle'));
Route::get('/yetkiliyap/{id?}',array('as'=>'yetkiliyap','uses'=>'SayfaController@getYetkiliyap'));
Route::get('/yetkial/{id?}',array('as'=>'yetkial','uses'=>'SayfaController@getYetkial'));
Route::get('/kategorisil/{id?}',array('as'=>'kategorisil','uses'=>'SayfaController@getKategorisil'));
Route::get('/userpage',array('as'=>'userpage','uses'=>'HomeController@getUserpage'));

Route::get('/deneme', array('as'=>'deneme','uses'=>'PageController@getDeneme'));
Route::post('/ticketcevapekle',array('as'=>'ticketcevapekle','uses'=>'SayfaController@postCevapekle'));

Route::get('/cvponayla/{id?}',array('as'=>'cvponayla','uses'=>'SayfaController@getCvponayla'));
Route::get('/cvpreddet/{id?}',array('as'=>'cvpreddet','uses'=>'SayfaController@getCvpreddet'));