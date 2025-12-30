<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// In-memory students data for display (no DB required)
Route::get('/dbconn', function () {
    $students = collect([
        ['std_id' => 1, 'std_name' => 'Alice',     'std_fname' => 'Anderson'],
        ['std_id' => 2, 'std_name' => 'Bob',       'std_fname' => 'Brown'],
        ['std_id' => 3, 'std_name' => 'Carlos',    'std_fname' => 'Cruz'],
        ['std_id' => 4, 'std_name' => 'Diana',     'std_fname' => 'Dawson'],
        ['std_id' => 5, 'std_name' => 'Eva',       'std_fname' => 'Edwards'],
        ['std_id' => 6, 'std_name' => 'Frank',     'std_fname' => 'Fletcher'],
        ['std_id' => 7, 'std_name' => 'Grace',     'std_fname' => 'Green'],
        ['std_id' => 8, 'std_name' => 'Hector',    'std_fname' => 'Hughes'],
        ['std_id' => 9, 'std_name' => 'Ivy',       'std_fname' => 'Irving'],
        ['std_id' => 10,'std_name' => 'Jack',      'std_fname' => 'Johnson'],
    ]);

    return view('dbconn', ['students' => $students]);
});
