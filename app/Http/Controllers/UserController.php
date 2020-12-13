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
    
        if($logged){
            $name = Auth::user()->name;
            return redirect()->route('home.index')->with('success', "Bem Vindo $name!");
        } else {
            return back()->with('error', 'Login Inválido!')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function accessRequest($user, $status)
    {
        $requesting_user = User::find($user);

        if(!isset($requesting_user)){
            return back()->with('error', 'Usuário não encontrado!');
        }

        $requesting_user->access_granted = ($status == 'granted');
        $requesting_user->access_denied = !$requesting_user->access_granted;

        $requesting_user->save();

        $msg = $requesting_user->access_granted ? 'Acesso permitido!' : 'Acesso bloqueado!';

        return back()->with('success', $msg);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules);

        if($validation->fails()) {
            return back()->with('errors', $validation->errors())->withInput();
        } else {
            if($request->password == $request->password_confirm){
                $access_granted = false;

                if(is_numeric($request->company)){
                    $company = Company::find($request->company);
                } else {
                    $company = Company::create(['name' => $request->company]);
                    $access_granted = true;
                }
                
                if(!isset($company)){
                    return back()->with('error', 'Empresa informada não existe!');
                }

                $data = $request->all();
                $data['company_id'] = $company->id;
                $data['access_granted'] = $access_granted;

                $user = User::create($data);

                if(isset($request->webmode)){
                    Auth::login($user, true);
                    return redirect()->route('home.index');
                } else {
                    return response()->json(['message' => 'User created!']);                
                }
            } else {
                return back()->with('error', 'As senhas não conferem')->withInput();
            }
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