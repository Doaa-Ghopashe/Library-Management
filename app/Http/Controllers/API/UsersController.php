<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
Use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->is_admin==2){
            return "admin";
        }
        elseif(auth()->is_admin==1){
            return "Super admin";
        }
        else{
            return "user";
        }
    }

    // public function adminHome()
    // {
    //     if(auth)
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        // if($user->role==1){
            $user->email=$request->email;
            $user->name=$request->name;
            // $user->password=\Hash::make($request->password);
            $user->role=$request->role;
            $user->save();
            return $user;

        // }
        // else{
        //     return 'sorry u cant update';
        // }
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $user=User::find($id);
        // if(auth::user()->role==1){
            User::find($id)->delete();
            return "user is deleted ";

            

       // }
        // else{
        //     return 'sorry u cant delete';
        // }
    }
}
