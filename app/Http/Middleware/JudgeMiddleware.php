<?php

namespace App\Http\Middleware;

use App\Models\Judge;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JudgeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($judge = Auth::guard('webjudge')->user())
            return $next($request);
        else
            return redirect('/judge/login')->with('message', 'login to access the website');
        return $next($request);
    }
}
