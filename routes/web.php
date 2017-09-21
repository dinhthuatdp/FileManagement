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

use App\Http\Controllers\YoloController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/yolo', function () {
    return view('yolo');
});

Route::get('yolo/login', function () {

    return view('login');
});
/*
Route::post('yolo/login', function() {
    $ylController = new YoloController();
    $ylController->login();
});
 */
 
Route::post('yolo/login', 'Auth\LoginController@login');
//Route::post('yolo/login', function(\Illuminate\Http\Request $request){
//    $loginController = new LoginController();
//    $loginController->login($request);
//});

Route::post('yolo/upload', 'YoloController@upload');

Route::get('yolo/signout', function () {
    if (!is_null(session()->get('sessionLogin'))) {
        session()->forget('sessionLogin');
    }
    return view('login');
});

Route::get('yolo/files', 'YoloController@getAllFile');

Route::get('yolo/files/page/{pagenumber}', function ($pagenumber) {

    $ylController = new YoloController();
    $paginator = $ylController->getAllFileByPage($pagenumber);
    return view('files',['paginator'=>$paginator]);
});

Route::get('yolo/files/download/{filename}/{savename}/{type}', function($filename, $savename, $type){
    
    $ylController = new YoloController();
    $ylController->download($type, $savename, $filename);
});

Route::get('/yolo/files/{id}','YoloController@sortByFileName');