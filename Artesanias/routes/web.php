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
    return view('hola');
});
Route::get('/producto/{id}', function ($id) {
   
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
