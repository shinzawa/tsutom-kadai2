<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products()
    {
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
        // must delete old file 
        $product = Product::find($productId);
        $image = $product->image;
        // delete old file
        if (!empty($image)) {
            Storage::disk('public')->delete($image);
        }
        $image = $request->file('image');
        if (isset($image)) {
            $path = $image->store('', 'public');
        }

        // DB register oparation 
        $data = $request->only([
            'name',
            'price',
            'description'
        ]);
        $data = array_merge($data, ['image' => $path]);
        dd($product);
        $product->update($product);

        foreach ($request->seasons as $season_id) {
            $sa[] = $season_id;
        }
        $product->seasons()->sync($sa);

        return $this->products();
    }

    public function search(Request $request)
    {
        $query = Product::query();

        $query = $this->getSearchQuery($request, $query);

        $products = $query->paginate(6);

        $seasons = Season::all();
        return view('product', compact('products', 'seasons'));
    }

    public function register(RegisterRequest $request)
    {
        // store image file to defined place
        $image = $request->file('image');
        if (isset($image)) {
            $path = $image->store('', 'public');
        }
        // DB register oparation 
        $data = $request->only([
            'name',
            'price',
            'description'
        ]);
        $data = array_merge($data, ['image' => $path]);
        $product = Product::create($data);
        $seasons = $request->seasons;
        foreach ($seasons as $season_id) {
            $sa[] = $season_id;
        }
        $product->seasons()->attach($sa);

        return $this->products();
    }

    public function destroy(Request $request, $productId)
    {
        $product = Product::find($productId);
        $image = $product['image'];
        if (isset($image)) {
            Storage::disk('public')->delete($image);
        }

        // destroy one record from the table
        Product::find($productId)->delete();

        return $this->products();
    }

    public function getSearchQuery(Request $request, $query)
    {
        if (!empty($request->order)) {
            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%')
                    ->orderBy('price', $request->order);
            } else {
                $query->orderBy('created_at', $request->order);
            }
        } else {
            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
        }

        return $query;
    }
}
