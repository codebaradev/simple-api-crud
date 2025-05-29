<?php

use App\Http\Controllers\StudentController;
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

Route::get('/students', [StudentController::class, 'index'])
    ->name('students.index');

require __DIR__.'/auth.php';
