<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function terlaris(){
        // $data = Product::select(['product_name', 'qty'])->groupBy('product_id')->orderBy('jumlah_pemesanan', 'DESC');
    }
}
