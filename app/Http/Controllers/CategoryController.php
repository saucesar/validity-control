<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $params = [
            'categories' => Auth::user()->company->categoriesPaginated(),
        ];

        return view('categories/index', $params);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['send_to'] = $this->removeNull($data['send_to']);
        $data['company_id']  =  Auth::user()->company->id;

        $category = Category::create($data);

        if(isset($category)) {
            return back()->with('success', 'Categoria adicionada!');
        } else {
            return back()->with('error', 'Falha ao adicionar categoria!');
        }
    }

    private function removeNull($array)
    {
        $a = [];
        foreach($array as $element) {
            if($element != null) {
                $a[] = $element;
            }
        }

        return $a;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
