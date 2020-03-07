<?php

namespace App\Http\Middleware;

use Closure;

class ApiKeyValidate
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
      if (!$request->has("api_key")) {
        return response()->json([
          'status' => 400,
          'message' => 'Acceso no autorizado',
        ], 400);
      }
  
      if ($request->has("api_key")) {
        $api_key = '$2y$10$ijgHm6PCsN2/G7bH0/6tzelzeas3t.2wlGTJWgDGwHJvJ.U49hH4i';
        if ($request->input("api_key") != $api_key) {
          return response()->json([
            'status' => 400,
            'message' => 'Token no válido',
          ], 400);
        }
      }
      return $next($request);
    }
}
