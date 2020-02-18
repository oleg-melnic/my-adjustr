<?php

namespace App\Http\Middleware;

use App\Services\User\UserService;
use Closure;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->type !== UserService::TYPE_ADMIN) {
            return new Response(view('unauthorized')->with('role', 'ADMIN'));
        }

        return $next($request);
    }
}
