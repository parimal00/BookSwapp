<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadBookController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('viewBooks',[UploadBookController::class,'viewBooks']);

Route::post('swap_books',[UploadBookController::class,'sendNotification']);

Route::post('postBook',[UploadBookController::class,'uploadBooks']);

Route::post('view_notification',[UploadBookController::class,'getNotification']);

Route::post('acceptReq',[UploadBookController::class,'acceptReq']);
Route::post('rejectReq',[UploadBookController::class,'rejectReq']);


Route::get('messages',[UploadBookController::class,'getMessages']);


Route::get('check',[UploadBookController::class,'getMessages']);






