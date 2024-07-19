<?php

use App\Http\Controllers\Admin\attributeController;
use App\Http\Controllers\Admin\brandController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\colorController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\homeBannerController;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\admin\profileController;
use App\Http\Controllers\Admin\sizeController;
use App\Http\Controllers\Admin\taxController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin/index');
});

// Delete Data
Route::get('/deleteData/{id?}/{table?}', [dashboardController::class, 'deleteData']);

// Profile Section
Route::get('/profile', [profileController::class, 'index']);
Route::post('/saveProfile', [profileController::class, 'store']);

// Home Banner
Route::get('/homeBanner', [homeBannerController::class, 'index']);
Route::post('/updateHomeBanner', [homeBannerController::class, 'store']);

// Manage Size
Route::get('/manageSize', [sizeController::class, 'index']);
Route::post('/updateSize', [sizeController::class, 'store']);

// Manage Color
Route::get('/manageColor', [colorController::class, 'index']);
Route::post('/updateColor', [colorController::class, 'store']);

// Manage Attribute
Route::get('/attributeName', [attributeController::class, 'indexAttributeName']);
Route::post('/updateAttributeName', [attributeController::class, 'storeAttributeName']);

// Manage Attribute Value
Route::get('/attributeValue', [attributeController::class, 'indexAttributeValue']);
Route::post('/updateAttributeValue', [attributeController::class, 'storeAttributeValue']);

// Manage Category
Route::get('/category', [categoryController::class, 'index']);
Route::post('/updateCategory', [categoryController::class, 'store']);

// Manage Category Attribute
Route::get('/categoryAttribute', [categoryController::class, 'indexCategoryAttribute']);
Route::post('/updateCategoryAttribute', [categoryController::class, 'storeCategoryAttribute']);

// Manage Brand
Route::get('/brand', [brandController::class, 'index']);
Route::post('/updateBrand', [brandController::class, 'store']);

// Manage Tax
Route::get('/tax', [taxController::class, 'index']);
Route::post('/updateTax', [taxController::class, 'store']);

// Manage product
Route::get('/product', [productController::class, 'index']);
Route::get('/manageProduct/{id}', [productController::class, 'viewProduct']);
Route::post('/updateProduct', [productController::class, 'store']);
Route::post('/getAttributes', [productController::class, 'getAttributes']);