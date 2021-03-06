<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class CORS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        $all_url = explode(',', env('all_cors_login_url'));

        $path = [
            'login/yunwei',
            '/login'
        ];
        $allowCorsPath = [
            'rule/detail'
        ];

        $requestPath = urldecode($request->path());
        $response = $next($request);
        //if (in_array($requestPath, $path) && in_array($origin, $all_url)) {
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS,X-CSRF-TOKEN');
            $response->header('Access-Control-Allow-Credentials', 'true');
            return $response;
        //} elseif (Str::contains($requestPath, $allowCorsPath) && in_array('header', get_class_methods(get_class($response)))) {
        //     $response->header('Access-Control-Allow-Origin', '*');
        //     $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
        //     $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS,X-CSRF-TOKEN');
        //     $response->header('Access-Control-Allow-Credentials', 'true');
        //     return $response;
        // }

        return $response;
    }
}
