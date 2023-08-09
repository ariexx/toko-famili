<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): ?string
    {
        if(auth()->check()) {
            if(auth()->user()->isAdmin()) {
                return $next($request);
            }else{
                alert()->error('Error', 'You are not allowed to access this page');
                return redirect()->route('admin.login');
            }
        }

        alert()->error('Error', 'You are not allowed to access this page');
        return redirect()->route('login');
    }
}
