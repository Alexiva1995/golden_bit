<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB RUTAS.
|--------------------------------------------------------------------------
|
| Esta es la ruta inicial del sistema.
| puedes agregar o modificar dicha ruta y seleccionar en las configuraciones
| una nueva ruta principal.
|
*/
Route::prefix('mioficina')->group(function(){
    Route::get('/', 'HomeController@index')->name('index');
});

/*Route::get('/', function(){
    // $landing = 0;
    return redirect()->route('index');
    // return view('landing.index', compact('landing'));
})->name('landing');*/

Route::get('/', function(){
    return redirect()->route('login');
});

Route::get('/producto/legal', function(){
    $landing = 3;
    return view('landing.index', compact('landing'));
})->name('product');

Route::get('/faq/legal', function(){
    $landing = 2;
    return view('landing.index', compact('landing'));
})->name('faq');

Route::get('{tipo}/legal', function($tipo){
    $landing = 1;
    return view('landing.index', compact('landing', 'tipo'));
})->name('legal');

// Route::prefix('landing')->group(function(){
    
// });




