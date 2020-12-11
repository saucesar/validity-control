<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $rules = [
        'name' => 'required|min:5',
        'email' => 'required|email:rfc|unique:users',
        'company' => 'required',
        'password' => 'required|min:8',
        'password_confirm' => 'required|min:8',
    ];

    public function login(Request $request)
    {
        $logged = Auth::attempt($request->only(['email', 'password']), isset($request->remember));
        if(isset($request->webmode)){
            if($logged){
                return redirect()->route('home.index')->with('success', 'Bem Vindo!');
            } else {
                return back()->with('error', 'Login Inválido!')->withInput();
            }
        } else {
            return response()->json(['logged' => $logged], ($logged ? 200 : 400));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
    
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules);

        if($validation->fails()) {
            if(isset($request->webmode)){
                return back()->with('errors', $validation->errors())->withInput();
            } else {
                return response()->json($validation->errors(), 400);
            }
        } else {
            if($request->password == $request->password_confirm){
                $approved_access = false;

                if(is_numeric($request->company)){
                    $company = Company::find($request->company);
                } else {
                    $company = Company::create(['name' => $request->company]);
                    $approved_access = true;
                }
                
                if(!isset($company)){
                    return back()->with('error', 'Empresa informada não existe!');
                }

                $data = $request->all();
                $data['company_id'] = $company->id;
                $data['approved_access'] = $approved_access;

                $user = User::create($data);

                if(isset($request->webmode)){
                    Auth::login($user, true);
                    return redirect()->route('home.index');
                } else {
                    return response()->json(['message' => 'User created!']);                
                }
            } else {
                if(isset($request->webmode)){
                    return back()->with('error', 'As senhas não conferem')->withInput();
                } else {
                    return response()->json(['message' => 'The password and confirmation do not match!'], 400);
                }
            }
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if(isset($user)){
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found!'], 400);  
        }
    }

    public function create()
    {
        return view('users.new_user');
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), $this->rules);

        if($validation->fails()) {
            return response()->json($validation->errors(), 400);
        } else {
            $user = User::find($id);
            
            if(!isset($user)){
                return response()->json(['message' => 'User not found!!'], 400);
            } else if($request->password == $request->password_confirm){
                $user->update($request->all());
                return response()->json(['message' => 'User updated!']);                
            } else {
                return response()->json(['message' => 'The password and confirmation do not match!'], 400);
            }
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
            
        if(isset($user)){
            $user->delete();
            return response()->json(['message' => 'User deleted!']);
        } else {
            return response()->json(['message' => 'User not found!!!'], 400);
        }
    }
}