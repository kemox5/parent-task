<?php

use Illuminate\Support\Facades\Route;
use Modules\UsersModule\Controllers\TransactionController;

Route::get('v1/users', [TransactionController::class, 'list_users'])->name('users.list');
