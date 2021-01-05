<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeUserPasswordRequest;
use App\Http\Requests\StoreUserResquest;
use App\Http\Requests\UpdateUserResquest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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

    public function store(StoreUserResquest $request)
    {
        $access_granted = false;
        $new_company = false;
        if(is_numeric($request->company)){
            $company = Company::find($request->company);
        } else {
            $company = Company::create(['name' => $request->company]);
            $access_granted = true;
            $new_company = true;
        }
        if(!isset($company)){
            return back()->withErrors(['company' => 'Empresa informada não existe!'])->withInput();
        }

        $data = $request->except(['_token', 'password_confirmation']);
        $data['company_id'] = $company->id;
        $data['access_granted'] = $access_granted;
        $data['password'] = bcrypt($data['password']);
        
        $user = User::create($data);

        if(isset($user)){
            if($new_company){
                $company->owner_id = $user->id;
                $company->save();
            }
            Auth::login($user, true);
            return redirect()->route('home.index')->with('success', "Bem vindo {$user->name}");
        } else {
            return back()->with('error', 'Não foi possível completar o cadastro!');
        }
    }

    public function create()
    {
        return view('users.new_user');
    }

    public function update(UpdateUserResquest $request, $id)
    {
        $user = User::find($id);
            
        if(!isset($user)){
            return back()->with('error', 'Usuário não encontrado !!');
        } else {
            if($request->email != $user->email && User::where('email', $request->email)->exists()){
                return back()->withErrors(['email' => 'O email informado já pertence a outro usuário!!']);
            }
            $user->update($request->all());

            return back()->with('success', 'Informações Atualizadas!');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
            
        if(isset($user)){
            $user->delete();
            return redirect()->route('login')->with('success', 'Usuário deletado!');
        } else {
            return back()->with('error', 'Usuário não encontrado!');
        }
    }

    public function information()
    {
        return view('users/info');
    }

    public function changePassword(ChangeUserPasswordRequest $request, $id)
    {
        $user = User::find($id);
            
        if(!isset($user)){
            return back()->with('error', 'Usuário não encontrado !!');
        } else {
            if(Hash::check($request->oldpass, $user->password)){
                $user->update(['password' => bcrypt($request->newpass)]);
                return back()->with('success', 'Senha Atualizada!');
            } else {
                return back()->withErrors(['oldpass' => 'A senha informada está incorreta!'])->withInput();
            }
        }
   }
}