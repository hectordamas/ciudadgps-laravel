<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::resource('category', App\Http\Controllers\CategoriesController::class);
    Route::get('/home', [App\Http\Controllers\IndexController::class, 'index'])->name('home');

    Route::group(['middleware' => 'admin'], function() {
        Route::get('/administrador', function(){
            return view('home');
        });

        Route::get('/commerces', [App\Http\Controllers\CommerceController::class, 'index'])->name('commerces.index');
        Route::get('/commerces/create', [App\Http\Controllers\CommerceController::class, 'create'])->name('commerces.create');
        Route::get('/commerces/filter', [App\Http\Controllers\CommerceController::class, 'filter'])->name('commerces.filter');
        Route::post('/commerces/store', [App\Http\Controllers\CommerceController::class, 'store'])->name('commerces.store');
        Route::get('/commerces/{id}/edit', [App\Http\Controllers\CommerceController::class, 'edit']);
        Route::post('/commerces/{id}/update', [App\Http\Controllers\CommerceController::class, 'update']);
        Route::post('/images-upload', [App\Http\Controllers\CommerceController::class, 'imagesUpload']);
        Route::post('/imagesDestroy/{id}', [App\Http\Controllers\CommerceController::class, 'imagesDestroy']);
        Route::post('/action', [App\Http\Controllers\CommerceController::class, 'action']);
    
        Route::get('/banners/create', [App\Http\Controllers\BannerController::class, 'create'])->name('banners.create');
        Route::get('/banners', [App\Http\Controllers\BannerController::class, 'index'])->name('banners.index');
        Route::post('/banners/store', [App\Http\Controllers\BannerController::class, 'store'])->name('banners.store');
        Route::get('/banners/{id}/edit', [App\Http\Controllers\BannerController::class, 'edit']);
        Route::post('/banners/{id}/update', [App\Http\Controllers\BannerController::class, 'update'])->name('banners.update');
    
        Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
        Route::get('/users/create', [App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
        Route::post('/users/store', [App\Http\Controllers\UsersController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
        Route::post('/users/{id}/update', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');

        Route::resource('stories', App\Http\Controllers\StoryController::class);
        Route::resource('storyitems', App\Http\Controllers\StoryItemController::class);
        Route::post('/eliminarVariosItems', [App\Http\Controllers\DestroyStoryItemsController::class, 'destroy']);
    });

    Route::get('/mi-cuenta', [App\Http\Controllers\Public\UsersController::class, 'mi_cuenta']);
    Route::post('/update/account/{id}', [App\Http\Controllers\Public\UsersController::class, 'update']);
    Route::get('/favoritos', [App\Http\Controllers\Public\UsersController::class, 'favoritos']);

    Route::post('/comment/store', [App\Http\Controllers\Public\CommentsController::class, 'store']);

    Route::get('cambiar-contraseña', [App\Http\Controllers\Public\AuthController::class, 'password']);
});

Route::get('/comercios', [App\Http\Controllers\Public\ComerciosController::class, 'index']);
Route::get('/faq', function(){ return view('public.faq'); });
Route::get('/planes', function() {
    return view('public.pricing');
});
Route::get('/nosotros', function(){ return view('public.about'); });
Route::get('/eliminar-cuenta', function(){ return view('public.eliminarCuenta'); });

Route::get('/registrar-comercio', [App\Http\Controllers\Public\ComerciosController::class, 'registrar']);
Route::post('/comercios/store', [App\Http\Controllers\Public\ComerciosController::class, 'store'])->name('public.commerces.store');
Route::get('/comercios/{id}', [App\Http\Controllers\Public\ComerciosController::class, 'show']);
Route::get('/comercios/{id}/redirect', [App\Http\Controllers\Public\ComerciosController::class, 'redirect']);
Route::get('/comercios/categorias/{id}', [App\Http\Controllers\Public\ComerciosController::class, 'categoria']);
Route::get('/politicas-de-privacidad', function(){ return view('privacidad'); });

Route::get('comentarios-de-comercios/{id}', [App\Http\Controllers\Public\CommentsController::class, 'index']);

Route::get('auth/google', [App\Http\Controllers\Public\GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\Public\GoogleController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [App\Http\Controllers\Public\FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [App\Http\Controllers\Public\FacebookController::class, 'handleFacebookCallback']);

Route::get('auth/apple', [App\Http\Controllers\Public\AppleController::class, 'redirectToApple']);
Route::post('auth/apple/callback', [App\Http\Controllers\Public\AppleController::class, 'handleAppleCallback']);

Route::post('solicitarCodigo', [App\Http\Controllers\Public\AuthController::class, 'solicitarCodigo']);
Route::post('comprobarCodigo', [App\Http\Controllers\Public\AuthController::class, 'comprobarCodigo']);
Route::post('cambiarContraseña', [App\Http\Controllers\Public\AuthController::class, 'cambiarContraseña']);

Route::get('pago-online', [App\Http\Controllers\Public\StripeController::class, 'pagoOnline']);
Route::post('stripe-post', [App\Http\Controllers\Public\StripeController::class, 'stripe'])->name('stripe.post');

Route::get('catalogo/{id}/share', [App\Http\Controllers\Public\ComerciosController::class, 'shareCatalogo']);
Route::get('/catalogo-de-productos/{id}', [App\Http\Controllers\Public\ComerciosController::class, 'catalogo']);
Route::get('/productos/{id}/share', [App\Http\Controllers\Public\ComerciosController::class, 'productShare']);
Route::get('/productos/{id}', [App\Http\Controllers\Public\ProductsController::class, 'show']);

Route::get('/empleos', [App\Http\Controllers\Public\JobsController::class, 'index']);
Route::get('/jobs/{id}', [App\Http\Controllers\Public\JobsController::class, 'show']);
Route::get('/empleos/{id}/redirect', [App\Http\Controllers\Public\JobsController::class, 'redirect']);

Route::get('/carrito-de-compras', [App\Http\Controllers\Public\CartController::class, 'index']);
Route::get('/checkout', [App\Http\Controllers\Public\CartController::class, 'checkout']);
Route::post('/addToCart', [App\Http\Controllers\Public\CartController::class, 'addToCart']);
Route::post('/deleteCartItem', [App\Http\Controllers\Public\CartController::class, 'deleteCartItem']);
Route::post('/updateCartItem', [App\Http\Controllers\Public\CartController::class, 'updateCartItem']);

Route::post('/save-location', [App\Http\Controllers\Public\LocationController::class, 'saveLocation']);

Route::get('/categorias', [App\Http\Controllers\Public\CategoriesController::class, 'index']);
