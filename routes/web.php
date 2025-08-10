<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('/cqrs-demo', [AccountController::class, 'demo']);
