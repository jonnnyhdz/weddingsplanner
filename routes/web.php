<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Rutas para el controlador de contactos
Route::get('/mostrar-formulario', [ContactoController::class, 'mostrarFormulario'])->name('mostrar_formulario');
Route::post('/guardar-contacto', [ContactoController::class, 'guardarContacto'])->name('guardar_contacto');
Route::get('/mostrar-contactos', [ContactoController::class, 'mostrarContactos'])->name('mostrar_contactos');

require __DIR__.'/auth.php';
