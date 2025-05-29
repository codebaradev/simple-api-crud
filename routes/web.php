<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'Laravel' => app()->version(),
        'urls' => [
            'login' => '/login',
            'register' => '/register'
        ]
    ];
});

require __DIR__.'/auth.php';
