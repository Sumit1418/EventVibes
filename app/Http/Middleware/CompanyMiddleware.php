<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!isset($_SESSION)){
            session_start();
        }

        if(isset($_SESSION['isauthenticated']) && $_SESSION['isauthenticated']==true && $_SESSION['user_type']=='company'){
            return $next($request);
        }
        return redirect('/login');
    }
}
