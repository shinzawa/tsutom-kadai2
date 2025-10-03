<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\RegisterRequest;

class ProductController extends Controller
{
    public function products()
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
        $seasons = $product->seasons()->get();
        return view('update', compact('product', 'seasons'));
    }

    public function update(RegisterRequest $request, $productId)
    {
        if ($request->has('back')) {
            return redirect('/products');
        }

        $form = $request->all();
        unset($form['_token']);
        $product = Product::find($productId);
        foreach ($request->seasons as $season_id) {
            $sa[] = $season_id;
        }
        $product->seasons()->sync($sa);
        unset($form['seasons']);
        unset($form['_method']);
        dd($form);
        $product->update($form);

        return $this->products();
    }

    public function search(Request $request)
    {
        // TODO search
        $query = Product::query();
        $products = $query->paginate(6);
        $seasons = Season::all();
        return view('products', compact('product', 'seasons'));
    }

    public function register(RegisterRequest $request)
    {
        if ($request->has('back')) {
            return redirect('/products');
        }

        dd($request);
        // TODO register oparation 
        $product = Product::create(
            $request->only([
                'name',
                'price',
                'image',
                'description'
            ])
        );
        $seasons = $request->seasons;
        foreach ($seasons as $season_id) {
            $sa[] = $season_id;
        }
        $product->seasons()->attach($sa);

        return $this->products();
    }

    public function destroy(Request $request, $productId)
    {
        // TODO destroy one record
        Product::find($productId)->delete();

        return $this->products();
    }
}
