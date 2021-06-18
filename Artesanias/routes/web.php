<?php

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
    return view('index');
});

Route::get('/producto/{id}', function ($id,$nombre) {
   
    return view('verproducto')
    ->with('id',$id);
});
Route::get('/contacto', 
    
    function () {
        $contacto='Aneth Ochoa';
        $valores=7;
        $color="#ccc";
            return view('contacto')
            ->with('nombre',$contacto)
            ->with('fondo',$color)
            ->with('valores',$valores);
});

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/usuarios', 'Admin\UsuariosController@index');

    Route::get('/clientes', 'Admin\ClientesController@index');
    Route::get('/generarPDF', 'Admin\ClientesController@generar');
    
    Route::get('/categorias', function () {
        return view('admin.categorias');
    });
    Route::get('/productos', 'Admin\ProductosController@index');
    Route::post('/productos/edit', 'Admin\ProductosController@edit');

    Route::resource('productos', 'Admin\ProductosController');
    Route::resource('usuarios', 'Admin\UsuariosController');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
