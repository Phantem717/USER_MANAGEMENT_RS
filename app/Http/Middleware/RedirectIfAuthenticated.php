<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && !$request->is('user/dashboard') && !$request->is('admin/dashboard')) {
                $user = User::find(id: Auth::id());
                // dd($user);
                $userRole = $user->hasRole(Auth::id());
                if(!$userRole){
                    return view('auth.login');
        
                } else{
                    if ($userRole->role_id == 1) {
                        return redirect()->route('admin.dashboard');
                    } elseif ($userRole->role_id == 2) {
                        return redirect()->route('user.dashboard');
                    } else {
                        // handle other roles or no role
                    }
                }            }
        }

        return $next($request);
    }
}
