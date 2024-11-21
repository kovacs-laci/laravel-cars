<?php

use App\Http\Controllers\BodyController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransmissionController;
use App\Http\Controllers\TrimController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/bodies', [BodyController::class, 'store'])->name('bodies.store');
    Route::get('/bodies/create', [BodyController::class, 'create'])->name('bodies.create');
    Route::patch('/bodies/{body}', [BodyController::class, 'update'])->name('bodies.update');
    Route::get('/bodies/{body}/edit', [BodyController::class, 'edit'])->name('bodies.edit');
    Route::delete('/bodies/{body}', [BodyController::class, 'destroy'])->name('bodies.destroy');

    Route::post('/fuels', [FuelController::class, 'store'])->name('fuels.store');
    Route::get('/fuels/create', [FuelController::class, 'create'])->name('fuels.create');
    Route::get('/fuels/{fuel}/edit', [FuelController::class, 'edit'])->name('fuels.edit');
    Route::patch('/fuels/{fuel}', [FuelController::class, 'update'])->name('fuels.update');
    Route::delete('/fuels/{fuel}', [FuelController::class, 'destroy'])->name('fuels.destroy');

    Route::post('/makers', [MakerController::class, 'store'])->name('makers.store');
    Route::get('/makers/create', [MakerController::class, 'create'])->name('makers.create');
    Route::get('/makers/{maker}/edit', [MakerController::class, 'edit'])->name('makers.edit');
    Route::patch('/makers/{maker}', [MakerController::class, 'update'])->name('makers.update');
    Route::delete('/makers/{maker}', [MakerController::class, 'destroy'])->name('makers.destroy');
    Route::get('/makers/{maker}/models', [MakerController::class, 'showModels'])->name('makers.models');
    Route::get('/makers/{maker}/fetch-models', [MakerController::class, 'fetchModels'])->name('makers.fetch.models');

    Route::post('/models', [ModelController::class, 'store'])->name('models.store');
    Route::get('/models/create', [ModelController::class, 'create'])->name('models.create');
    Route::get('/models/{model}/edit', [ModelController::class, 'edit'])->name('models.edit');
    Route::patch('/models/{model}', [ModelController::class, 'update'])->name('models.update');
    Route::delete('/models/{model}', [ModelController::class, 'destroy'])->name('models.destroy');
    Route::get('/models/{model}/fetch-trims', [ModelController::class, 'fetchTrims'])->name('models.fetch.trims');

    Route::post('/trims', [TrimController::class, 'store'])->name('trims.store');
    Route::get('/trims/create', [TrimController::class, 'create'])->name('trims.create');
    Route::get('/trims/{trim}/edit', [TrimController::class, 'edit'])->name('trims.edit');
    Route::patch('/trims/{trim}', [TrimController::class, 'update'])->name('trims.update');
    Route::delete('/trims/{trim}', [TrimController::class, 'destroy'])->name('trims.destroy');

    Route::post('/transmissions', [TransmissionController::class, 'store'])->name('transmissions.store');
    Route::get('/transmissions/create', [TransmissionController::class, 'create'])->name('transmissions.create');
    Route::get('/transmissions/{transmission}/edit', [TransmissionController::class, 'edit'])->name('transmissions.edit');
    Route::patch('/transmissions/{transmission}', [TransmissionController::class, 'update'])->name('transmissions.update');
    Route::delete('/transmissions/{transmission}', [TransmissionController::class, 'destroy'])->name('transmissions.destroy');

    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::patch('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
});

require __DIR__.'/auth.php';

Route::get('/bodies', [BodyController::class, 'index'])->name('bodies.index');
Route::get('/bodies/{body}', [BodyController::class, 'show'])->name('bodies.show');

Route::get('/makers', [MakerController::class, 'index'])->name('makers.index');
Route::get('/makers/{maker}', [MakerController::class, 'show'])->name('makers.show');
Route::get('/makers/filter/{ch}', [MakerController::class, 'filter'])->name('makers.filter');
Route::post('manufacturers/search', [MakerController::class, 'search'])->name('makers.search');

Route::get('/fuels', [FuelController::class, 'index'])->name('fuels.index');
Route::get('/fuels/{fuel}', [FuelController::class, 'show'])->name('fuels.show');

Route::get('/models', [ModelController::class, 'index'])->name('models.index');
Route::get('/models/{model}', [ModelController::class, 'show'])->name('models.show');
Route::post('/models/filter', [ModelController::class, 'filter'])->name('models.filter');

Route::get('/trims', [TrimController::class, 'index'])->name('trims.index');
Route::get('/trims/{trim}', [TrimController::class, 'show'])->name('trims.show');
Route::post('/trims/filter', [TrimController::class, 'filter'])->name('trims.filter');

Route::get('/transmissions', [TransmissionController::class, 'index'])->name('transmissions.index');
Route::get('/transmissions/{transmission}', [TransmissionController::class, 'show'])->name('transmissions.show');

Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
