<?php

use App\Livewire\Alunos\Index as AlunosIndex;
use App\Livewire\Empresas\Index as EmpresasIndex;
use App\Livewire\Professores\Index as ProfessoresIndex;
use App\Livewire\Resgate\Index as ResgateIndex;
use App\Livewire\Transacoes\Index as TransacoesIndex;
use App\Livewire\User\Profile;
use App\Livewire\User\Resgate;
use App\Livewire\Password\Reset;
use App\Livewire\Password\Recovery;
use Illuminate\Support\Facades\Route;
use App\Livewire\Users\Index;
use App\Livewire\Vantagem\Index as VantagemIndex;

Route::get('/resgate', ResgateIndex::class)->name('resgate');
Route::get('/reset-password', Reset::class)->name('reset-password');
Route::get('/password/recovery/{token}', Recovery::class)->name('recovery-password');
Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/users', Index::class)->name('users.index');

    Route::get('/user/profile', Profile::class)->name('user.profile');

    Route::get('/user/vantagens', Resgate::class)->name('user.resgates');

    Route::get('/alunos', AlunosIndex::class)->name('alunos.index');

    Route::get('/empresas-parceiras', EmpresasIndex::class)->name('empresas.index');
    
    Route::get('/professores', ProfessoresIndex::class)->name('professores.index');

    Route::get('/transacoes', TransacoesIndex::class)->name('transacoes.index');

    Route::get('/vantagens', VantagemIndex::class)->name('vantagens.index');
});

require __DIR__.'/auth.php';
