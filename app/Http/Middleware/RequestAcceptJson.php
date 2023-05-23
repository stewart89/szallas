<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestAcceptJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!$request->headers->has('Accept')) {
            return response()->json(
                [
                    'success' => false, 
                    'message' => 'The Accept header is missing.'
                ]
            );
        }

        if($request->headers->get('Accept') !== 'application/json'){
            return response()->json(
                [
                    'success' => false, 
                    'message' => 'The Accept header must be set to application/json'
                ]);
        }
        
        return $next($request);
    }
}
