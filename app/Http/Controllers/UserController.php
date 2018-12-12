<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Auth;
use Auth;

class UserController extends Controller
{
    public function login()
    {
      $credentials = [
        'email' => request('email'),
        'password' => request('password')
      ];

      if (Auth::attempt($credentials)) {
        $success['token'] = Auth::user()->createToken('MyApp')->accessToken;
        return response()->json(['success' => $success]);
      }

      return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(){
      //Auth::logout();
      return response()->json(['logout' => true]);
    }

    public function register(Request $request){
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
      }

      $input = $request->all();
      $input['password'] = bcrypt($input['password']);

      $user = User::create($input);
      $success['token'] = $user->createToken('MyApp')->accessToken;
      $success['name'] = $user->name;

      return response()->json(['success' => $success]);
    }

    public function getDetails(){
      return response()->json(['success' => Auth::user()]);
    }
}
