<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductApiController extends Controller
{

    public function index()
    {
        return response()->json(['products' => Auth::guard('api')->user()->company->products]);
    }

    public function store(ProductStoreRequest $request)
    {
        $exists = Product::where('barcode', $request->barcode)
                         ->where('company_id', Auth::guard('api')->user()->company->id)
                         ->first();
        
        if($exists){
            return response()->json(['message' => 'Existe um produto com o codigo informado!'], 409);
        } else {
            Product::create($request->all());

            return response()->json(['message' => 'Produto criado!']);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        if(isset($product)){
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        if(isset($product)){
            $product->update($request->all());
            return response()->json(['message' => 'Produto atualizado!']);
        } else {
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(isset($product)){
            $product->delete();
            return response()->json(['message' => 'Produto deletado!']);
        } else {
            return response()->json(['message' => 'Produto não encontrado!'], 404);
        }
    }
}
