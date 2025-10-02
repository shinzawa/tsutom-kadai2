<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        // if (sort) sort
        // else 
        $query = Product::query();
        $products = $query->paginate(6);
        $seasons = Season::all();
        return view('product', compact('products', 'seasons'));
    }

    public function product($productId)
    {
        $product = Product::find($productId);
        $seasons = $product->seasons();
        return view('update', compact('product', 'seasons'));
    }

    public function update(Request $request)
    {
        // update
        $query = Product::query();
        $products = $query->paginate(6);
        $seasons = Season::all();

        return view('products', compact('products', 'seasons'));
    }

    public function search(Request $request)
    {
        // TODO search
        $query = Product::query();
        $products = $query->paginate(6);
        $seasons = Season::all();
        return view('products', compact('product', 'seasons'));
    }

    public function register(Request $request)
    {
        if ($request->has('back')) {
            return redirect('/products');
        }
        // TODO register oparation 
        $query = Product::query();
        $products = $query->paginate(6);
        $seasons = Season::all();
        return view('products', compact('product', 'seasons'));
    }

    public function destroy(Request $request)
    {
        // TODO destroy one record
        $query = Product::query();
        $products = $query->paginate(6);
        $seasons = Season::all();
        return view('products', compact('product', 'seasons'));
    }
}
