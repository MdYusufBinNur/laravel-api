<?php

namespace App\Http\Middleware;

use App\DbModels\Property;
use Closure;
use Illuminate\Support\Facades\Config;

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

        $propertyId = $request->headers->has('propertyId') ? $request->headers->get('propertyId') : $request->get('propertyId');
        if (!empty($propertyId)) {


            $request->merge(['propertyId' => $propertyId]);
            $property = Property::find($propertyId);

            //temporary enable for reformedtech office
            if ($property->subdomain == 'test') {
                Config::set('mail.driver', 'mailgun');
            }

            \View::share('property', $property);
        }

        $response = $next($request);
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Headers", "Origin, Content-Type, Accept, Authorization, X-Requested-With, propertyId");
        $response->headers->set("Access-Control-Allow-Methods", "OPTIONS, HEAD, GET, POST, PUT, DELETE");
        $response->headers->set("CrossOrigin", "Anonymous");

        return $response;
    }
}
