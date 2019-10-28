<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class AdminsOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth('api')->check()) {
            $user = auth('api')->user()->load('role');

            if($user->role->id == 1){
                return $next($request);
            }
        }

        return Response::json([
            'resultado' => [
                'status' => 'fail',
                'error' => 'Access for admins only'
            ]
        ]);

    }
}
