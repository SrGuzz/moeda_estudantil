<?php

use App\Livewire\Alunos\Index as AlunosIndex;
use App\Livewire\Empresas\Index as EmpresasIndex;
use App\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Users\Index;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/users', Index::class)->name('users.index');

    Route::get('/user/profile', Profile::class)->name('user.profile');

    Route::get('/alunos', AlunosIndex::class)->name('alunos.index');

    Route::get('/empresas-parceiras', EmpresasIndex::class)->name('empresas.index');
});

require __DIR__.'/auth.php';
