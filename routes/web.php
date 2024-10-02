<?php

use App\Models\Inventory;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

/**
 * Costumer Routes
 * ***************
 */

Route::view('/costumer/w', 'welcome-costumer');

Volt::route('/costumer/l', 'costumer.login-costumer')->name('login-costumer');
Volt::route('/costumer/r', 'costumer.register-costumer')->name('register-costumer');
Route::view('/search', 'livewire.costumer.search-item')->middleware(['auth', 'verified'])->name('search-item');
Route::view('/costumer/c/c', 'livewire.costumer.shopping-car')->middleware(['auth', 'verified'])->name('shopping-car');
Route::view('/costumer/p/s', 'livewire.costumer.pay-sale')->middleware(['auth', 'verified'])->name('pay-sale');
Route::view('/costumer/s/s', 'livewire.costumer.status-sale')->middleware(['auth', 'verified'])->name('status-sale');

/*----------------------------------------------------------------------------------- */

/**
 * Employee Routes
 * ***************
 */

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::view('bcv', 'bcv')->middleware(['auth', 'verified'])->name('bcv');
Route::view('box', 'box')->middleware(['auth', 'verified'])->name('box');
Route::view('daily-closing', 'daily-closing')->middleware(['auth', 'verified'])->name('daily-closing');
Route::view('bills', 'bills')->middleware(['auth', 'verified'])->name('bills');
Route::view('inventory', 'inventory')->middleware(['auth', 'verified'])->name('inventory');
Route::view('daily-sale', 'inventory')->middleware(['auth', 'verified'])->name('daily-sale');
Route::view('on-line', 'on-line')->middleware(['auth', 'verified'])->name('on-line');
Route::view('profile', 'profile')->middleware(['auth', 'verified'])->name('profile');


/**Route for  list items view */
Route::get('/list/items/{sale_code}', function (string $sale_code) {
    dd($sale_code);
    return 'User '.$sale_code;
});
 
 /*----------------------------------------------------------------------------------- */


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';


Route::get('/ex', function () {
    try {

        $array = ['35', '36', '37', '38', '39', '40'];

        // $array = ['5','5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '10'];

        // $array = ['35'];


        for ($i=0; $i < count($array) ; $i++) { 
            $inventario = new Inventory();
            $inventario->sku = 'Eden09';
            $inventario->product = 'Eden09';
            $inventario->code = 'CA-'.random_int(11111111, 99999999);
            $inventario->category_id = 6;
            $inventario->subcategory_id = 15;
            $inventario->size = $array[$i];
            $inventario->color = 'silver';
            // $inventario->size = 35.5;
            // $inventario->price = 35;
            $inventario->quantity = 0;
            // $inventario->material = 'patente';
            // $inventario->variation_1 = 'padreria';
            $inventario->created_by = 'Gustavo Camacho';
            $inventario->save();
            # code...
        }
        dd('listo');
        //code...
    } catch (\Throwable $th) {
        dd($th);
    }
    
});

Route::get('/xx', function () {
    return redirect(route('filament.admin.auth.login'));
})->name('xx');
