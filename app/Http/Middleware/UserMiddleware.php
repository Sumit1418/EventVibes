<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
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

        if(isset($_SESSION['isauthenticated']) && $_SESSION['isauthenticated']==true && $_SESSION['user_type']=='user'){
            return $next($request);
        }
        return redirect('/login');
    }
}
