<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): ?string
    {
        if(auth()->check() && auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            abort(403);
    }
}
