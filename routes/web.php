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

        Route::post('/update-image-order', [App\Http\Controllers\CommerceController::class, 'updateImageOrder']);

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
    
        Route::get('pushnotifications', [App\Http\Controllers\PushNotificationsController::class, 'index']);
        Route::get('/pushnotifications/create', [App\Http\Controllers\PushNotificationsController::class, 'create']);
        Route::post('/pushnotificatons/store', [App\Http\Controllers\PushNotificationsController::class, 'store'])->name('pushnotifications.store');
    
        Route::get('articles/index', [App\Http\Controllers\ArticleController::class, 'list']);
        Route::get('articles/create', [App\Http\Controllers\ArticleController::class, 'create']);
        Route::post('articles/store', [App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
        Route::get('articles/{id}/edit', [App\Http\Controllers\ArticleController::class, 'edit']);
        Route::post('articles/{id}/update', [App\Http\Controllers\ArticleController::class, 'update']);
    }); 

    Route::get('/mi-cuenta', [App\Http\Controllers\Public\UsersController::class, 'mi_cuenta']);
    Route::post('/update/account/{id}', [App\Http\Controllers\Public\UsersController::class, 'update']);
    Route::get('/favoritos', [App\Http\Controllers\Public\UsersController::class, 'favoritos']);

    Route::post('/comment/store', [App\Http\Controllers\Public\CommentsController::class, 'store']);

    Route::get('cambiar-contraseña', [App\Http\Controllers\Public\AuthController::class, 'password']);

    Route::get('chat', [App\Http\Controllers\Public\ChatController::class, 'chat']);
    Route::post('handleChatRequest', [App\Http\Controllers\Public\ChatController::class, 'handleChatRequest']);
    Route::get('/conversations/{id}/show', [App\Http\Controllers\Public\ChatController::class, 'show']);

    Route::get('locales-asociados', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'index']);
    Route::get('locales-asociados/{id}/edit', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'edit']);
    Route::post('/upload-logo', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'uploadLogo'])->name('upload-logo');

    Route::post('locales-asociados/setIsEnable', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'setIsEnable']);
    Route::get('locales-asociados/productos/{id}', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'productos']);
    Route::post('locales-asociados/products/store', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'productsStore']);
    Route::get('locales-asociados/productos/{id}/edit', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'productsEdit']);
    Route::post('locales-asociados/productos/{id}/update', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'productsUpdate']);
    Route::post('locales-asociados/productos/{id}/destroy', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'productsDestroy']);

    Route::post('locales-asociados/categories/store', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'categoriesStore']);
    Route::get('locales-asociados/categories/{id}/edit', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'categoriesEdit']);
    Route::post('locales-asociados/categories/{id}/update', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'categoriesUpdate']);
    Route::post('locales-asociados/categories/{id}/destroy', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'categoriesDestroy']);

    Route::get('locales-asociados/jobs/{id}', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'jobs']);
    Route::post('locales-asociados/jobs/store', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'jobsStore']);
    Route::get('locales-asociados/jobs/{id}/edit', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'jobsEdit']);
    Route::post('locales-asociados/jobs/{id}/update', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'jobsUpdate']);
    Route::post('locales-asociados/jobs/{id}/destroy', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'jobsDestroy']);

    Route::get('locales-asociados/horarios/{id}', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'horarios']);
    Route::post('locales-asociados/cambiarHorarios', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'cambiarHorarios']);

    Route::get('locales-asociados/performance/{id}', [App\Http\Controllers\Public\LocalesAsociadosController::class, 'reporteDeVisitas']);
});

Route::get('/comercios', [App\Http\Controllers\Public\ComerciosController::class, 'index']);
Route::get('/faq', function(){ return view('public.faq'); });
Route::get('/planes', function() {  return view('public.pricing'); });
Route::get('/nosotros', function(){ return view('public.about'); });
Route::get('/eliminar-cuenta', function(){ return view('public.eliminarCuenta'); });
Route::get('/politicas-de-privacidad', function(){ return view('privacidad'); });

Route::get('/registrar-comercio', [App\Http\Controllers\Public\ComerciosController::class, 'registrar']);
Route::post('/comercios/store', [App\Http\Controllers\Public\ComerciosController::class, 'store'])->name('public.commerces.store');
Route::get('/comercios/{id}', [App\Http\Controllers\Public\ComerciosController::class, 'show']);
Route::get('/slug-comercios/{slug}', [App\Http\Controllers\Public\ComerciosController::class, 'showSlug']);
Route::get('/comercios/{id}/redirect', [App\Http\Controllers\Public\ComerciosController::class, 'redirect']);

Route::get('/comercios/categorias/{id}', [App\Http\Controllers\Public\ComerciosController::class, 'categoria']);
Route::get('/comercios/slug-categorias/{slug}', [App\Http\Controllers\Public\ComerciosController::class, 'categoriaSlug']);

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
Route::get('/catalogo-productos/{slug}', [App\Http\Controllers\Public\ComerciosController::class, 'catalogoSlug']);

Route::get('/productos/{id}/share', [App\Http\Controllers\Public\ComerciosController::class, 'productShare']);
Route::get('/productos/{id}', [App\Http\Controllers\Public\ProductsController::class, 'show']);
Route::get('/slug-productos/{slug}', [App\Http\Controllers\Public\ProductsController::class, 'showSlug']);

Route::get('/empleos', [App\Http\Controllers\Public\JobsController::class, 'index']);
Route::get('/jobs/{id}', [App\Http\Controllers\Public\JobsController::class, 'show']);
Route::get('/empleo/{slug}', [App\Http\Controllers\Public\JobsController::class, 'showSlug']);
Route::get('/empleos/{id}/redirect', [App\Http\Controllers\Public\JobsController::class, 'redirect']);

Route::get('/carrito-de-compras', [App\Http\Controllers\Public\CartController::class, 'index']);
Route::get('/checkout', [App\Http\Controllers\Public\CartController::class, 'checkout']);
Route::post('/addToCart', [App\Http\Controllers\Public\CartController::class, 'addToCart']);
Route::post('/deleteCartItem', [App\Http\Controllers\Public\CartController::class, 'deleteCartItem']);
Route::post('/updateCartItem', [App\Http\Controllers\Public\CartController::class, 'updateCartItem']);

Route::post('/save-location', [App\Http\Controllers\Public\LocationController::class, 'saveLocation']);
Route::post('/getPushNotificationData', [App\Http\Controllers\PushNotificationsController::class, 'show']);

Route::get('/categorias', [App\Http\Controllers\Public\CategoriesController::class, 'index']);

Route::get('/blog', [App\Http\Controllers\ArticleController::class, 'index']);
Route::get('/blog/{slug}', [App\Http\Controllers\ArticleController::class, 'show']);
Route::get('/search/blog', [App\Http\Controllers\ArticleController::class, 'search']);
Route::get('/search/tags/{id}', [App\Http\Controllers\ArticleController::class, 'tags']);

