<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
Use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;


class AuthController extends Controller
{
    public function create(AuthRequest $request){
        //authorization
        //validation
        // $request->validate([
        //     "email" =>'required',
        //     'name'=>'required|max:25',
        //     "password"=>'required|max:20',
        //     "role"=>'required',
        // ]);

        //store in db
        $user =new User();
        $user->email=$request->email;
        $user->name=$request->name;
        $user->password=\Hash::make($request->password);
        $user->role=$request->role;
        $user->save();

       
        // $user->createToken('ios')->plainTextToken;

        return [
            '$user'=>$user,
            'token'=> $user->createToken('ios')->plainTextToken
        ];
        // return $user;

        //return response

    }


    // public function login(request $request){
    //     // $user =new User();
    //    if(\Auth::attempt($request->only('email','password'))); 

    //     return [
    //         '$user'=>\Auth::$user(),
    //         'token'=>\Auth::$user()->createToken('android')->plainTextToken
    //     ];
    // }
    // public function login(LoginRequest $request){
    //     // $user =new User();
    //    if(\Auth::attempt($request->only('email','password'))); 
       
    //     return [
    //         'user'=>\Auth::user(),
    //         'token'=>\Auth::user()->createToken('android')->plainTextToken
    //     ];
    // }
    public function login(LoginRequest $request){
        // $user =new User();
       if(\Auth::attempt($request->only('email','password'))){
          return [
            'user'=>\Auth::user(),
            'token'=>\Auth::user()->createToken('android')->plainTextToken
        ];
    }
        else{
            return "it's not a valiable";
        }

       }
       
      
    }

    //////
    // authenticate the user
    // public function login(LoginRequest $request){
    //     if(\Auth::attempt($request->only('email','password'))) 
    //             return [
    //             'user'=> \Auth::user(),
    //             'token' => \Auth::user()->createToken('android')->plainTextToken
    //         ];
            
    //     }
                

