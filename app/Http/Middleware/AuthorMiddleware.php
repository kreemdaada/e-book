<?php

// app/Http/Middleware/AuthorMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_author) {
            return $next($request);
        }

        return redirect()->route('home.index')->with('error', 'Access denied.');
    }
}
