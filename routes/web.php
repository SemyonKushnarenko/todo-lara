<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::any('{all}', function () {
    $user = Auth::user();
    return view('app')->with(compact('user'));
})
    ->where(['all' => '.*']);
