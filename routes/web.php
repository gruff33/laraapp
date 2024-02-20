<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Acronym;
use App\Livewire\Change\ChangeMainView;
use App\Livewire\Nodes\NodesMainView;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/test',   Acronym::class)->name('test');
    Route::get('/change', ChangeMainView::class)->name('change');
    Route::get('/nodes',  NodesMainView::class)->name('nodes');
});
