<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    public function terlaris(){
        // $data = ::select(['product_name', 'qty'])->groupBy('product_id')->orderBy('jumlah_pemesanan', 'DESC');
        $data = DetailOrder::with(['product','order' => function($query){
            $query->where('status', 4);
        }])->groupBy('product_id')->orderBy('qty' , 'DESC')->selectRaw('product_id, SUM(qty) as qty')->limit(10)->get();
        return view('terlaris', [
            'data' => $data,
        ]);
    }
}
