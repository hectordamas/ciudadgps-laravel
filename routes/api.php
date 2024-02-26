<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('home', [App\Http\Controllers\Api\ApiHomeController::class, 'home']);
Route::get('categories', [App\Http\Controllers\Api\CategoriesController::class, 'index']);
Route::get('getAppStoresVersion', [App\Http\Controllers\Api\ApiHomeController::class, 'getAppStoresVersion']);
Route::get('stories', [App\Http\Controllers\Api\ApiHomeController::class, 'stories']);
Route::post('deviceToken/store', [App\Http\Controllers\Api\DeviceTokenController::class, 'store']);
Route::get('comments', [App\Http\Controllers\Api\CommentsController::class, 'index']);
Route::get('category/commerces', [App\Http\Controllers\Api\CategoriesController::class, 'getCommerces']);
Route::get('likes', [App\Http\Controllers\Api\LikesController::class, 'likes']);
Route::get('searchCommerces', [App\Http\Controllers\Api\CommerceController::class, 'searchCommerces']);
Route::post('getCommerces', [App\Http\Controllers\Api\CommerceController::class, 'getCommerces']);
Route::post('getCommercesDestacados', [App\Http\Controllers\Api\CommerceController::class, 'getCommercesDestacados']);
Route::post('showCommerce/{id}', [App\Http\Controllers\Api\CommerceController::class, 'show']);
Route::post('commerce/store', [App\Http\Controllers\Api\CommerceController::class, 'store']);
Route::post('stripe/paymentIntent', [App\Http\Controllers\Api\StripeController::class, 'paymentIntent']);
Route::post('ticket/store', [App\Http\Controllers\Api\TicketController::class, 'store']);

Route::get('/products/{id}/show', [App\Http\Controllers\Api\ProductsController::class, 'show']);

Route::post('/users/setToken', [App\Http\Controllers\Api\UsersController::class, 'setToken']);
Route::post('/users/setGenderAndBirthday', [App\Http\Controllers\Api\UsersController::class, 'setGenderAndBirthday']);

//Preguntas y respuestas
Route::post('questions/{questionId}/show', [App\Http\Controllers\Api\QuestionController::class, 'show']);
Route::get('getQuestionsCommerce/{commerceId}', [App\Http\Controllers\Api\QuestionController::class, 'getQuestionsCommerce']);
Route::post('questions/{questionId}/edit', [App\Http\Controllers\Api\QuestionController::class, 'edit']);
Route::post('questions/{questionId}/destroy', [App\Http\Controllers\Api\QuestionController::class, 'destroy']);

//Answers
Route::post('answers/{answerId}/edit', [App\Http\Controllers\Api\AnswerController::class, 'edit']);

//Jobs
Route::post('/getCommerceJobsData', [App\Http\Controllers\Api\JobsController::class, 'getCommerceJobsData']);

Route::group(['prefix' => 'auth'], function () {    
    //Horarios de atencion
    Route::post('hours', [App\Http\Controllers\Api\HoursController::class, 'index']);
    Route::post('setHour', [App\Http\Controllers\Api\HoursController::class, 'setHour']);
    Route::post('setHourEnable', [App\Http\Controllers\Api\HoursController::class, 'setHourEnable']);

    //Auth
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('signup', [App\Http\Controllers\Api\AuthController::class, 'signUp']);

    Route::post('solicitarCodigo', [App\Http\Controllers\Api\AuthController::class, 'solicitarCodigo']);

    Route::get('getProducts', [App\Http\Controllers\Api\ProductsController::class, 'getProducts']);

    Route::get('/searchJobs', [App\Http\Controllers\Api\JobsController::class, 'searchJobs']);
    Route::get('/jobs', [App\Http\Controllers\Api\JobsController::class, 'index']);
    Route::get('/jobs/{id}/edit', [App\Http\Controllers\Api\JobsController::class, 'edit']);

    //Olvidó su contrasena
    Route::post('comprobarCodigo', [App\Http\Controllers\Api\AuthController::class, 'comprobarCodigo']);
    Route::post('cambiarContraseña', [App\Http\Controllers\Api\AuthController::class, 'cambiarContraseña']);

    Route::group(['middleware' => 'auth:api'], function() {
        //Editar productos
        Route::post('/products', [App\Http\Controllers\Api\ProductsController::class, 'index']);
        Route::post('/products/create', [App\Http\Controllers\Api\ProductsController::class, 'create']);
        Route::get('/products/{product_id}/edit', [App\Http\Controllers\Api\ProductsController::class, 'edit']);
        Route::post('/products/store', [App\Http\Controllers\Api\ProductsController::class, 'store']);
        Route::post('/products/update', [App\Http\Controllers\Api\ProductsController::class, 'update']);
        Route::post('/products/destroy', [App\Http\Controllers\Api\ProductsController::class, 'destroy']);
        Route::post('setIsEnabled', [App\Http\Controllers\Api\ProductsController::class, 'setIsEnabled']);
        Route::post('hideProduct', [App\Http\Controllers\Api\ProductsController::class, 'hideProduct']);

        //Crear una categoria de catalogo
        Route::post('pcategories/store', [App\Http\Controllers\Api\PcategoryController::class, 'store']);
        Route::post('pcategories', [App\Http\Controllers\Api\PcategoryController::class, 'index']);
        Route::post('pcategories/{pcategoryId}/update', [App\Http\Controllers\Api\PcategoryController::class, 'update']);
        Route::post('pcategories/{pcategoryId}/destroy', [App\Http\Controllers\Api\PcategoryController::class, 'destroy']);

        //Editar bolsa de empleos
        Route::get('/getJobs', [App\Http\Controllers\Api\JobsController::class, 'getJobs']);
        Route::post('/jobs/store', [App\Http\Controllers\Api\JobsController::class, 'store']);
        Route::post('/jobs/update', [App\Http\Controllers\Api\JobsController::class, 'update']);
        Route::post('/jobs/destroy', [App\Http\Controllers\Api\JobsController::class, 'destroy']);

        //Reporte de visitas
        Route::get('/visits', [App\Http\Controllers\Api\VisitsController::class, 'index']);

        //Likes
        Route::post('like', [App\Http\Controllers\Api\LikesController::class, 'like']);
        Route::post('dislike', [App\Http\Controllers\Api\LikesController::class, 'dislike']);

        //editar historias
        Route::post('newStory', [App\Http\Controllers\Api\CommerceController::class, 'newStory']);
        Route::post('destroyStory', [App\Http\Controllers\Api\CommerceController::class, 'destroyStory']);

        //editar fotos del local
        Route::post('photos/{id}/update', [App\Http\Controllers\Api\ImagesController::class, 'update']);
        Route::post('logo/{id}/update', [App\Http\Controllers\Api\ImagesController::class, 'updateLogo']);
        Route::post('photos/{id}/destroy', [App\Http\Controllers\Api\ImagesController::class, 'destroy']);
        
        //Editar información del local
        Route::get('commerce/{id}/edit', [App\Http\Controllers\Api\CommerceController::class, 'edit']);
        Route::post('commerce/{id}/update', [App\Http\Controllers\Api\CommerceController::class, 'update']);

        //Solicitar código para asociar
        Route::get('comercios/asociados', [App\Http\Controllers\Api\ComerciosAsociadosController::class, 'index']);
        Route::post('comercio/solicitarCodigo', [App\Http\Controllers\Api\ComerciosAsociadosController::class, 'solicitarCodigo']);
        Route::post('comercio/comprobarCodigo', [App\Http\Controllers\Api\ComerciosAsociadosController::class, 'comprobarCodigo']);

        //editar usuarios
        Route::get('users/{id}/edit', [App\Http\Controllers\Api\UsersController::class, 'edit']);
        Route::post('users/{id}/update', [App\Http\Controllers\Api\UsersController::class, 'update']);
        Route::post('users/{id}/destroy', [App\Http\Controllers\Api\UsersController::class, 'destroy']);
        Route::post('avatarUpdate/{id}', [App\Http\Controllers\Api\UsersController::class, 'avatarUpdate']);
        
        //cerrar iniciar sesión
        Route::get('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::get('user', [App\Http\Controllers\Api\AuthController::class, 'user']);

        //Crear comentarios
        Route::post('comments/store', [App\Http\Controllers\Api\CommentsController::class, 'store']);

        //Crear Preguntas
        Route::post('questions/store', [App\Http\Controllers\Api\QuestionController::class, 'store']);
        Route::post('questions/{questionId}/destroy', [App\Http\Controllers\Api\QuestionController::class, 'destroy']);
        
        //Crear Respuesta
        Route::post('answers/store', [App\Http\Controllers\Api\AnswerController::class, 'store']);
        Route::post('answers/{answerId}/destroy', [App\Http\Controllers\Api\AnswerController::class, 'destroy']);
    
    });
});


