<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class AdminPass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $persona = DB::select('select rol from usuario where nombre = ? ', [$request->get('nombre')]);
        if ($persona && $persona[0]->rol == 1) {
            return $next($request);
        } else {
            return response()->json(null, 406);
        }
    }
}
