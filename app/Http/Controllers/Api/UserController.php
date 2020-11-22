<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $rules = [
        'name' => 'required|min:5',
        'email' => 'required|email:rfc|unique:users',
        'password' => 'required|min:8',
        'password_confirm' => 'required|min:8',
    ];

    public function login(Request $request)
    {
        $logged = Auth::attempt($request->only(['email', 'password']));
        
        return response()->json(['logged' => $logged], ($logged ? 200 : 400));
    }
    
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules);

        if($validation->fails()) {
            return response()->json($validation->errors(), 400);
        } else {
            if($request->password == $request->password_confirm){
                User::create($request->all());
                return response()->json(['message' => 'User created!']);                
            } else {
                return response()->json(['message' => 'The password and confirmation do not match!'], 400);
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