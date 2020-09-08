<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
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
        $user = Auth::user();
        $permission = \Illuminate\Support\Facades\Route::currentRouteName();

        if ($request->isMethod('get')) {
            if ($user->can($permission)) {
                return $next($request);
            } else {
                $notification = array(
                    'message' => 'You Dont Have Permission',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }
        } else {
            return $next($request);
        }
    }
}
