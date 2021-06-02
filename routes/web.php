<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('script', function(){
    $locations = [
        'Curitiba, PR, Brasil',
        'Cascavel, PR, Brasil',
        'Rio de Janeiro, RJ, Brasil',
        'Petrópolis, RJ, Brasil',
        'Belo Horizonte, MG, Brasil',
        'New York, NY, EUA',
        'Munique, BA, Alemanha',
        /* ... */
    ];
    $collect = collect($locations);
    $aux = collect();

    $collect = $collect->filter(function($n){
        [$city, $state, $country] = explode(', ', $n);
        if ($country == 'Brasil') {
            return $n;
        }
    } );

    $counted = $collect->countBy(function ($item) {
        [$city, $state, $country] = explode(', ', $item);
        return $state;
    });

    return $counted->count();
});
