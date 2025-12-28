<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dbconn', function () {
    // Query the std_table and pass results to the view
    $students = DB::table('std_table')->get();

    return view('dbconn', ['students' => $students]);
});