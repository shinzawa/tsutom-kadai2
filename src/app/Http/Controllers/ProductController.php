<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function products() {
        $query = Product::query();
        $products = $query->paginate(6);
        $seasons = Season::all();
        return view('product', compact('products', 'seasons'));
    }
}
