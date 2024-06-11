<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (Auth::check()) {
            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . Auth::user()->id, true,$expireTime);
            User::where('id',Auth::user()->id)->update(['last_seen' => Carbon::now()]);
         }

        
         if (Auth::check()) {
            $user = Auth::user();

            if (in_array($user->role, $roles)) {
                return $next($request);
            }

            // Redirect if the user does not have the right role
            return redirect('/index/logout');
        }

        // Redirect if the user is not authenticated
        return redirect('/');
    }
}
