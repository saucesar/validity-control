<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExpirationDate;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $rules = [
        'barcode' => 'required|min:8|max:13',
        'description' => 'required|min:5|max:256',
        'company_id' => 'required|numeric|min:1',
    ];

    private $rulesToUpdate = [
        'barcode' => 'required|min:8|max:13',
        'description' => 'required|min:5|max:256',
        'company_id' => 'required|numeric|min:1',
    ];

    public function index()
    {
        $user = Auth::user();

        $params = [
            'user' => $user,
            'products' => $user->getProducts(),
        ];

        return view('products/index', $params);
    }
    
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules);

        if($validation->fails()){
            return response()->json(['message' => $validation->errors()], 400);
        } else {
            $product = Product::where('company_id', $request->company_id)
                              ->where('barcode', $request->barcode)
                              ->get()->first();
                              
            if(isset($product)){
                return response()->json(['message' => 'bacorde already exists.'], 400);
            } else {
                Product::create($request->all());
                return response()->json(['message' => 'Product created!']);                
            }
        }
    }

    public function generalSearch(Request $request)
    {
        $search = $request->search;
        $user = Auth::user();

        $products = Product::orWhere('barcode', 'like', "%$search%")
                           ->orWhere('description', 'like', "%$search%")
                           ->where('company_id', $user->company->id);
        
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

    public function addDate(Request $request, $id)
    {
        $data = $request->all();
        $data['product_id'] = $id;

        ExpirationDate::create($data);

        return back()->with('success', 'Data adicionada!');
    }

    public function removeDate(Request $request, $id)
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

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $validation = Validator::make($request->all(), $this->rulesToUpdate);

            if($validation->fails()){
                return back()->with('errors', $validation->errors())->withInput();
            } else {
                $product->update($request->all());
                return back()->with('success', 'Produto atualizado!')->withInput();
            }
        } else {
            return back()->with('error', 'Product not found!')->withInput();
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $product->delete();
            return back()->with('success', 'Produto deletado!');
        } else {
            return back()->with('error', 'Produto não encontrado!');
        }
    }
}