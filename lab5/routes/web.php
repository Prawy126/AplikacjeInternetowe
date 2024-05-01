<?php

use App\Http\Controllers\TemperatureController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting/{name?}', function (?string $name = 'nieznajomy') {
    return '<h1>Witaj ' . $name . '</h1>';
});

Route::get('/temperatuer/ctf/{c?}',[TemperatureController::class, 'ctf']);


//...
Route::get('/zad9', function (Request $request) {
    $br = "<br>";
    $r = $request->path() . $br .
    $request->url() . $br .
    $request->fullUrl() . $br .
    $request->method(). $br .
    $request->isMethod('post'). $br .
    $request->header('User-Agent'). $br .
    $request->ip();
    return $r;
   });


   Route::get('/zad10', function (Request $request) {
    $br = "<br>";
    $r = print_r($request->all(), true) . $br .
    $request->query('a') . $br .
    $request->query('b', 'brak b') . $br .
    print_r($request->query(), true) . $br .
    $request->has(['a', 'b']) . $br .
    $request->filled(['a']) . $br;
    return $r;
   });

   Route::get('/zad13', function (Request $request) {
    $name = $request->name;
    $arr = ['a', 'b', 'c', 'd', 'e'];
    return view('zad13', ['name' => $name, 'arr' => $arr]);
});

Route::get('/trips', function () {
    return view('index');
});

