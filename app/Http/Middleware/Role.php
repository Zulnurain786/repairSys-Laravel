<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
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
        $role = str_replace(' ', '-', Auth::user()->role->name);
        if($request->getRequestUri()=='/' || $request->getRequestUri()==''){
            return redirect(url('/'.$role));
        }
        else{
            $request = Request::capture();
            $path = $request->path();
            $wordsToCheck = ['super-admin', 'company', 'staff','technician'];

            foreach ($wordsToCheck as $word) {
                if (preg_match("/\b$word\b/i", $path)){
                    if($role != $word){
                        $newPath = str_replace($word, $role, $path);
                        return redirect(url($newPath));
                    }
                }
            }
        }
        return $next($request);
    }
}
