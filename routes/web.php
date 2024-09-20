<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Route::get('dashboard', function () {
//     $users = User::where('id', '!=', auth()->user()->id)->get();
//     return view('dashboard', ['users' => $users]);
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/chat/{id}', function ($id) {
//     return view('chat', ['id' => $id]);
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('dashboard', ['users' => $users]);
    })->name('dashboard');

    // Chat route with unique name
    Route::get('/chat/{id}', function ($id) {
        return view('chat', ['id' => $id]);
    })->name('chat');

    // Profile route
    Route::view('/profile', 'profile')->name('profile');
});

require __DIR__ . '/auth.php';