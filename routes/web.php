<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;

Route::get('/', function () { return redirect('/api/documentation'); });

Route::get('/criaUser', function () {
    $rand = mt_rand();
    $defaultUser = [
                  'name' => "User-$rand",
                  'email' => "User-$rand@mail.com",
                  'password' => "pass-$rand"
   ];
    User::factory()->create($defaultUser);

    return response()->json($defaultUser, 201);
 });







