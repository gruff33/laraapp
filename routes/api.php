<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\NodeApiController;
use App\Http\Controllers\api\v1\NodeAttrApiController;
use App\Http\Controllers\api\v1\PackageApiController;
use App\Http\Controllers\api\v1\DomainAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1' ], function()
{
    Route::resources([
//        'acronym'  => AcronymAPIController::class,
        'node'     => NodeAPIController::class,     
        'nodeattr' => NodeAttrAPIController::class,
        'package'  => PackageAPIController::class,
        'domain'   => DomainAPIController::class
//        'storage'  => StorageAPIController::class
    ]);
});