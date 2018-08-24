<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index()
    {
        return view('product');
    }

    public function add(Request $request)
    {
        $request->validate(
            [
                'name'     => 'required',
                'quantity' => 'required|min:0',
                'price'    => 'required|min:0',
            ]
        );

        $product           = new Product();
        $product->name     = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->price    = $request->input('price');
        $product->save();

        return Response::json(["success" => true]);

    }

}
