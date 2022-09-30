<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

// The below route will return the first api.
Route::get("/sort/{string}",[TestController::class,'sortString']);

// The below route will return the second api.
Route::get("/arrange/{number}",[TestController::class,'arrangeNumber']);

// The below route will return the first api.
Route::get("/toBinary/{string}",[TestController::class,'getBinaryFromString']);

// The below route will return the first api.
Route::get("/prefix/{string}",[TestController::class,'getResultFromPrefix']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
