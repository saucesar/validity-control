<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    private $rules_to_update = [
        'name' => 'required|min:5',
        'oldpass' => 'required',
        'newpass' => 'required|min:8',
        'confirmnewpass' => 'required|min:8|same:newpass',
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
        $validation = Validator::make($request->all(), $this->rules_to_update);

        if($validation->fails()) {
            return back()->with('errors', $validation->errors())->withInput();
        } else {
            $user = User::find($id);
            
            if(!isset($user)){
                return back()->with('error', 'Usuário não encontrado !!');
            } else if(Hash::check($request->oldpass, $user->password)){
                $data = $request->all();
                $data['password'] = bcrypt($request->newpass);

                $user->update($data);
                return back()->with('success', 'Informações Atualizadas!');
            } else {
                return back()->with('error', 'A senha antiga está errada!')->withInput();
            }
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
            
        if(isset($user)){
            $user->delete();
            return redirect()->route('root')->with('success', 'Usuário deletado!');
        } else {
            return back()->with('error', 'Usuário não encontrado!');
        }
    }

    public function information()
    {
        $params = [
            'user' => Auth::user(),
        ];

        return view('users/info', $params);
    }
}