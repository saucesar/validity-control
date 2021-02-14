<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\ExpirationDate;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class ProductController extends Controller
{
    public function index()
    {
        $params = [
            'products' => Auth::user()->getProducts(),
            'categories' => Auth::user()->company->categories,
        ];

        return view('products/index', $params);
    }
    
    public function store(ProductStoreRequest $request)
    {
        $exists = Product::where('barcode', $request->barcode)
                         ->where('company_id', Auth::user()->company->id)
                         ->first();
        
        if($exists){
            return back()->with('error', 'Existe um produto com o codigo informado!');
        } else {
            $data = $request->all();
            $data['company_id'] = Auth::user()->company->id;
            Product::create($data);
            return back()->with('success', 'Produto criado!');
        }
    }

    public function generalSearch(Request $request)
    {
        $search = $request->search;

        $products = Product::orWhere('barcode', 'like', "%$search%")
                           ->orWhere('description', 'like', "%$search%")
                           ->where('company_id', Auth::user()->company->id)
                           ->distinct(['products.id'])
                           ->select('products.*');
        
        $params = [
            'products' => $products->paginate(10),
            'categories' => Auth::user()->company->categories,
            'searchData' => $request->except('_token'),
        ];

        return view('products/index', $params);
    }

    public function byCategory($category_id) {
        $products = Product::where('company_id', Auth::user()->company->id)
                           ->where('category_id', $category_id)
                           ->select('products.*')
                           ->paginate(10);

        $params = [
            'products' => $products,
            'categories' => Auth::user()->company->categories,
        ];
            
        return view('products/index', $params);
    }

    public function expirationDays(Request $request ,$days = null)
    {
        if(!isset($days)){
            $days = intval($request->days);
            !$days ? $days = 30 : $days;
        }

        $params = [
            'products' => Auth::user()->productsByExpiration(intval($days)),
            'categories' => Auth::user()->company->categories,
        ];

        return view('products/index', $params);
    }

    public function show($id){
        $product = Product::find($id);

        if(isset($product)){
            $graphic = $this->graficData($product);
            $group = $this->agroupDates($id);

            $recentChanges = ExpirationDate::where('product_id', $id)
                                           ->where('previous_id', '<>', null)
                                           ->orderBy('id', 'desc')
                                           ->take(10)
                                           ->get();
            
            $params = [
                'product' => $product,
                'categories' => Auth::user()->company->categories,
                'historic' => $group,
                'recentChanges' => $recentChanges,
                'dates' => $graphic['dates'],
                'graphicData' => json_encode($graphic['graphicData']),
            ];

            return view('products/show', $params);
        } else {
            return back()->with('error', 'Produto não encontrado!');
        }
    }

    private function agroupDates($productId)
    {
        $expdates = ExpirationDate::where('product_id', $productId)
                                  ->withTrashed()
                                  ->orderBy('date', 'desc')
                                  ->distinct(['expiration_dates.date'])
                                  ->take(10)
                                  ->get();
        $group = [];

        foreach($expdates as $expdate) {
            $group[$expdate->date] = ExpirationDate::where('product_id', $productId)
                                                   ->where('date', $expdate->date)
                                                   ->withTrashed()
                                                   ->orderBy('date', 'desc')
                                                   ->get();

        }

        return $group;
    }

    private function graficData(Product $product)
    {
        $dates = Array();
        $graphicData = Array();
        
        foreach($product->expirationDates as $expdate){
            $expdates = ExpirationDate::where('date', $expdate->date)->where('product_id', $product->id)
                                      ->withTrashed()->orderBy('created_at')->get();
            
            $dates[] = $expdate->date;
            $graphicData[$expdate->date] = [];

            foreach($expdates as $dt){
                $graphicData[$expdate->date][] = [$dt->created_at->format('d-m-Y'), $dt->amount, 'blue',  "$dt->amount"];
            }
        }

        return ['dates' => $dates, 'graphicData' => $graphicData];
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

    public function productsToPdf()
    {
        $pdf = PDF::loadView('products.pdf', ['title' => 'TITLE', 'products' => Auth::user()->getProductsWithoutPaginate()]);
        //$pdf->setPaper('A4', 'landscape');

        return $pdf->stream('products.pdf');
        
    }
}