<?php

use App\Http\Controllers\DetailOrderController;
use App\Models\DetailOrder;
use App\Models\Order;
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
Route::get('/terlaris', [DetailOrderController::class, 'terlaris']);
Route::get('/pembelian', function () {
   return view('pembelian', [
       'data'=> Order::with('customer')->groupBy('name')->orderBy('jumlah' , 'DESC')->selectRaw('name, COUNT(name) as jumlah')->limit(10)->get(),
   ]);
});
Route::get('/agent', function () {
   return view('agent', [
       'data'=> Order::with('agent')->groupBy('agent_name')->orderBy('jumlahcust' , 'DESC')->selectRaw('agent_name, COUNT(customer_id) as jumlahcust')->get(),
   ]);
});

Route::get('/daftarorder', function () {
    return view('daftarorder', [
        'data' => Order::paginate(10),
    ]);
});
Route::get('/daftarorder/detail/{id}', function ($id) {
    // dd(DetailOrder::with(['product'])->where('order_id', $id));
    return view('detail', [
        'data' => DetailOrder::with('product')->where('order_id', $id)->get(),
    ]);
});
