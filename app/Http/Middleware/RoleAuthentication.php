<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class RoleAuthentication
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = User::find(id: auth()->user()->id);

        if (!$user || !$user->hasRole($role)) {
            return redirect('/home')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
