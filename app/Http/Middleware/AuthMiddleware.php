<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->_token;
        
        if(!$token) {
            // Unauthorized response if token not there
            return __redirect('A token is required for authenticating the user. Please log in to get a token!', route('user.login'));
        }
        try {
            $credentials = JWT::decode($token, env('API_AUTH_KEY'), ['HS256']);
        } catch(ExpiredException $e) {
            return __redirect('The token has expired! Please login again to continue.', route('user.login'), 401);
        } catch(Exception $e) {
            return invalid('The token is invalid!', [], 422);
        }
        $user = User::find($credentials->sub);
        $request->auth = $user;
        return $next($request);

    }
}
