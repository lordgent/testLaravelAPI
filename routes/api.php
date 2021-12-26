<?php


use App\Http\Controllers\productController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::post('register', 'Auth/Register');

Route::get('products', [productController::class,'index']);
Route::post('product', [productController::class, 'store']);
Route::get('product/{id}', [productController::class, 'show']);
Route::put('product/{id}', [productController::class, 'update']);
Route::delete('product/{id}', [productController::class, 'destroy']);
Route::get("producttitle", [productController::class, 'titleCategory']);
// Category
Route::get('categories', [CategoryController::class,'index']);
Route::post('category', [CategoryController::class, 'create']);

// Transaction
