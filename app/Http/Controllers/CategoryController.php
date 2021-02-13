<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryEmailRequest;
use App\Models\Category;
use App\Models\EmailCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $params = [
            'categories' => Auth::user()->access_granted ? Auth::user()->company->categoriesPaginated() : null,
        ];

        return view('categories/index', $params);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['company_id']  =  Auth::user()->company->id;
        $category = Category::create($data);
        
        if(isset($category)) {

            foreach($request->emails as $email) {
                $exists = EmailCategory::where('email', $email)->where('category_id', $category->id)->exists();

                if(!$exists && isset($email)) {
                    EmailCategory::create(['email' => $email, 'category_id' => $category->id]);
                }
            }

            return back()->with('success', 'Categoria adicionada!');
        } else {
            return back()->with('error', 'Falha ao adicionar categoria!');
        }
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $params = [
            'categories' => Category::where('company_id', Auth::user()->company->id)->where('name', 'like', "%$search%")->paginate(Category::$page),
            'searchData' => $request->except('_token'),
        ];

        return view('categories/index', $params);
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

    public function addEmail(Request $request, $id){
        //dd($request->all());
        if(Category::find($id)){
            $exists = EmailCategory::where('email', $request->email)->where('category_id', $id)->exists();
            if($exists){
                return back()->with('error', 'Email já adicionado!');
            }

            EmailCategory::create(['email' => $request->email, 'category_id' => $id]);
            return back()->with('success', 'Email adicionado!');
        } else {
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    public function editEmail(Request $request, $id)
    {
        $emailCategory = EmailCategory::find($id);

        if(isset($emailCategory)) {
            $emailCategory->update($request->all());
            return back()->with('success', 'Email atualizado!');
        } else {
            return back()->with('error', 'Email informado não existe!');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if(isset($category)) {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Categoria deletada!');
        } else {
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    public function deteleEmail($id){
        $email = EmailCategory::find($id);

        if(isset($email)) {
            $email->delete();

            return back()->with('success', 'Email removido!');
        } else {
            return back()->with('error', 'Email não encontrado');
        }
    }
}
