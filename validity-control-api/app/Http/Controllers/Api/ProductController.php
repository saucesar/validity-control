<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $rules = [
        'barcode' => 'required|unique:products|min:8|max:13',
        'description' => 'required|min:5|max:256',
    ];

    public function index()
    {
        return response(Product::all()->toJson());
    }
    public function store(Request $request)
    {
        //Request body type URLencoded form data
        $validation = Validator::make($request->all(), $this->rules);

        if($validation->fails()){
            return response()->json(['message' => $validation->errors()]);
        } else {
            Product::create($request->all());
            return response()->json(['message' => 'Product created!']);
        }
    }

    public function search($barcode){
        $product = Product::where('barcode', $barcode);

        if($product->exists()) {
            return response($product->first()->toJson());
        } else {
            return response()->json(['message' => 'Product not found!'], 404);
        }
    }

    public function show($id){
        $product = Product::find($id);

        if(isset($product)) {
            return response($product->first()->toJson());
        } else {
            return response()->json(['message' => 'Product not found!'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $product->update($request->all());

            return response()->json(['message' => 'Product updated!']);
        } else {
            return response()->json(['message' => 'Product not found!'], 404);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $product->delete();

            return response()->json(['message' => 'Product deleted!']);
        } else {
            return response()->json(['message' => 'Product not found!'], 404);
        }
    }
}
