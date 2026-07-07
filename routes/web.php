<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\FrontPage\Landing;
use App\Livewire\Auth\Login;

Route::get('/', Landing::class)->name('landing');
Route::get('/login', Login::class)->name('login');
