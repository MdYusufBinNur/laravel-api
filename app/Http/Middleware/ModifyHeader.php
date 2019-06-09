<?php

namespace App\Http\Middleware;

use Closure;

class ModifyHeader
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->headers->get('Content-Type'))) {
            $request->headers->set('Content-Type', 'application/json');
        }

        if ($request->headers->get('Accept') == '*/*') {
            $request->headers->set('Accept', 'application/json');
        }

        $response = $next($request);
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Headers", "X-Requested-With, Content-Type");
        
        return $response;
    }
}
