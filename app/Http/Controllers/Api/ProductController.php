<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

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

    public function index(Request $request)
    {
        if(isset($request->company_id)){
            return response(Product::where('company_id', $request->company_id)->get()->toJson());            
        } else {
            return response()->json(['message' => 'Informe a empresa nos query params!'], 400);            
        }
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
        $user = User::find($request->user_id);

        $products = Product::orWhere('barcode', 'like', "%$search%")
                           ->orWhere('description', 'like', "%$search%")
                           ->orWhereJsonContains('expiration_dates', [$search])
                           ->where('company_id', $user->company->id);
            
        if(isset($request->webmode)){
            $params = [
                'user' => $user,
                'products' => $products->paginate(10),
                'searchData' => $request->except('_token'),
            ];

            return view('home/index', $params);
        } else {
            return response()->json($products->get()->toArray());
        }
    }

    public function addDate(Request $request, $id)
    {
        $product = Product::find($id);
        $date = Carbon::parse($request->date)->format('d-m-Y');

        $array = $product->expiration_dates;
        $array[] = ['date' => $date, 'amount' => $request->amount];
        $product->expiration_dates = $array;
        
        $product->save();
        if(isset($request->webmode)){
            return redirect()->route('home.index')->with('success', 'Data adicionada!');
        } else {
            return response()->json(['message' => 'Date is added']);
        }
    }

    public function removeDate(Request $request, $id)
    {
        $product = Product::find($id);
        $expiration_dates = $product->expiration_dates;
        
        foreach($expiration_dates as $key => $exp_date){
            if($exp_date['date'] == $request->date){
                unset($expiration_dates[$key]);
            }
        }

        $product->expiration_dates = count($expiration_dates) > 0 ? $expiration_dates : null;
        $product->save();

        if(isset($request->webmode)){
            return redirect()->route('home.index')->with('success', 'Data removida com sucesso!');
        } else {
            return response()->json(['message' => 'Date is removed!']);
        }
    }

    public function search(Request $request, $barcode){
        $product = Product::where('barcode', $barcode)
                          ->where('company_id', $request->company_id);

        if($product->exists()) {
            return response($product->first()->toJson());
        } else {
            return response()->json(['message' => 'Product not found!'], 400);
        }
    }

    public function show($id){
        $product = Product::find($id);

        if(isset($product)) {
            return response($product->first()->toJson());
        } else {
            return response()->json(['message' => 'Product not found!'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $validation = Validator::make($request->all(), $this->rulesToUpdate);

            if($validation->fails()){
                return response()->json(['message' => $validation->errors()], 400);
            } else {
                $product->update($request->all());
                return response()->json(['message' => 'Product updated!']);
            }
        } else {
            return response()->json(['message' => 'Product not found!'], 400);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $product->delete();

            return response()->json(['message' => 'Product deleted!']);
        } else {
            return response()->json(['message' => 'Product not found!'], 400);
        }
    }
    
    public function daysOfValidity(Request $request, $days)
    {
        if(!isset( $request->company_id)){
            return response()->json(['message' => 'company_id is required.'], 400);
        }
            
        $initialdate = Carbon::now();
        $finaldate = Carbon::now()->addDays($days);
        
        $products = Product::join('shelf_lives', 'products.id', '=', 'shelf_lives.product_id')
                           ->where('products.company_id', '=', $request->company_id)
                           ->whereDate('shelf_lives.date', '>=', $initialdate)
                           ->whereDate('shelf_lives.date', '<=', $finaldate)
                           ->get(['products.*', 'shelf_lives.date', 'shelf_lives.amount'])
                           ->toJson();
        
        return response($products);
    }  
}