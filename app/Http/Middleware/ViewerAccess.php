<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
Use Illuminate\Support\Facades\Auth;

class ViewerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin-api')->user()['role']==3 || Auth::guard('admin-api')->user()['role']==2 || Auth::guard('admin-api')->user()['role']==1){
            return $next($request);
        }
    return response()->json(['you do not have permission to access for this page']);

    }
}
