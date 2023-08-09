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

Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello',[\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello',[\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello/first',[\App\Http\Controllers\InputController::class, 'helloFirstName']);

Route::post('/input/hello/input',[\App\Http\Controllers\InputController::class, 'helloInput']);
Route::post('/input/hello/array',[\App\Http\Controllers\InputController::class, 'helloArray']);
Route::post('/input/hello/type',[\App\Http\Controllers\InputController::class, 'inputType']);

Route::post('/input/filter/only',[\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except',[\App\Http\Controllers\InputController::class, 'filterExcept']);
Route::post('/input/filter/merge',[\App\Http\Controllers\InputController::class, 'filterMerge']);
Route::post('/file/upload/',[\App\Http\Controllers\FileController::class, 'imageUpload'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class, 'createCookie']);
Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clearCookie']);

Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);

Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);
Route::get('/response/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
Route::get('/response/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);

Route::get('/middleware/api',function (){
   return "OK";
})->middleware(['contoh:PZN,401']);

Route::get('/middleware/group',function (){
    return "GROUP";
})->middleware(['PZN']);

