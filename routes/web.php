<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/sulis', function () {
    return 'Sulistyo Pradana - PZN';
});

Route::redirect('/youtube','/sulis');

Route::fallback(function (){
   return '404 Maaf tidak ada bosku';
});


// implementasi View
Route::view('/hello','hello',['name'=>'Sulis']);

Route::get('/hello-again',function (){
   return view('hello', ['name' => 'Sulis']);
});

Route::get('/hello-world',function (){
   return view('hello.world', ['name' => 'Sulis']);
});

Route::get('products/{id}', function ($productId){
    return "Product : " . $productId;
})->name('product.detail');

Route::get('products/{product}/items/{item}', function ($productId, $itemId){
    return "Product : " . $productId .", Items : " . $itemId;
})->name('product.item.detail');

Route::get('categories/{id}', function ($categoryId){
    return "Categories : " . $categoryId;
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function (string $userId = '404'){
   return "Users : ". $userId;
})->name('user.detail');

Route::get('/conflict/sulis', function (){
    return "Conflict Sulistyo";
});

Route::get('/conflict/{name}', function ($name){
    return "Conflict $name";
});

Route::get('/produk/{id}', function ($id){
   $link = route('product.detail',[
       'id' => $id
   ]);

   return "Link : $link";
});

Route::get('/produk-redirect/{id}', function ($id){
   return redirect()->route('product.detail', [
      'id' => $id
   ]);
});



