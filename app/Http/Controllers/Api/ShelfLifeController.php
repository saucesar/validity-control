<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShelfLife;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShelfLifeController extends Controller
{
    private $rules = [
        'amount' => 'required|min:1|numeric',
        'date' => 'required|date|after:today',
        'product_id' => 'required|min:1|numeric',
    ];

    public function index()
    {
        return response(ShelfLife::all()->toJson());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails()) {
            return response()->json(['messages' => $validator->errors()], 404);
        } else {
            ShelfLife::create($request->all());
            return response()->json(['message' => 'ShelfLife created!']);
        }
    }

    public function show($id)
    {
        $shelflife = ShelfLife::find($id);
        if(isset($shelflife)) {
            return response()->json($shelflife->toArray());
        } else {
            return response()->json(['message' => 'ShelfLife not found!'], 404);
        }
    }

    public function destroy($id)
    {
        $shelflife = ShelfLife::find($id);
        if(isset($shelflife)) {
            $shelflife->delete();
            return response()->json(['message' => 'ShelfLife deleted!']);
        } else {
            return response()->json(['message' => 'ShelfLife not found!'], 404);
        }
    }  
}