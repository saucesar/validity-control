<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpirationDateRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\ExpirationDate;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $params = [
            'user' => $user,
            'products' => $user->getProducts(),
        ];

        return view('products/index', $params);
    }
    
    public function store(ProductStoreRequest $request)
    {
        $exists = Product::where('barcode', $request->barcode)
                         ->where('company_id', Auth::guard('api')->user()->company->id)
                         ->first();
        
        if($exists){
            return back()->with('error', 'Existe um produto com o codigo informado!');
        } else {
            Product::create($request->all());
            return back()->with('success', 'Produto criado!');
        }
    }

    public function generalSearch(Request $request)
    {
        $search = $request->search;
        $user = Auth::user();

        $products = Product::orWhere('barcode', 'like', "%$search%")
                           ->orWhere('description', 'like', "%$search%")
                           ->join('expiration_dates', 'products.id', '=', 'expiration_dates.product_id')
                           ->orWhere('expiration_dates.lote', 'like', "%$search%")
                           ->where('company_id', $user->company->id)
                           ->select('products.*');
        
        $params = [
            'user' => $user,
            'products' => $products->paginate(10),
            'searchData' => $request->except('_token'),
        ];

        return view('products/index', $params);
    }

    public function expirationDays(Request $request ,$days = null)
    {
        $user = Auth::user();

        if(!isset($days)){
            $days = intval($request->days);
            !$days ? $days = 30 : $days;
        }

        $params = [
            'user' => $user,
            'products' => $user->getProductsByExpiration(intval($days)),
        ];

        return view('products/index', $params);
    }

    public function addDate(ExpirationDateRequest $request, $id)
    {
        $data = $request->all();
        $data['product_id'] = $id;

        ExpirationDate::create($data);

        return back()->with('success', 'Data adicionada!');
    }

    public function removeDate($id)
    {
        $date = ExpirationDate::find($id);
        $date->delete();

        return back()->with('success', 'Data removida com sucesso!');
    }

    public function show($id){
        $product = Product::find($id);

        if(isset($product)){
            $params = [
                'user' => Auth::user(),
                'product' => $product,
                'historic' => ExpirationDate::where('product_id', $id)->where('deleted_at', '<>', null)->withTrashed()->orderBy('id', 'desc')->get(),
            ];

            return view('products/show', $params);
        } else {
            return back()->with('error', 'Produto não encontrado!');
        }
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $product->update($request->all());
            return back()->with('success', 'Produto atualizado!');
        } else {
            return back()->with('error', 'Product não encontrado!')->withInput();
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Produto deletado!');
        } else {
            return back()->with('error', 'Produto não encontrado!');
        }
    }
}