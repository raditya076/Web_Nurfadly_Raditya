<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tes', function () {
    return response()->json(['pesan' => 'API Laravel Berhasil Terhubung!']);
});