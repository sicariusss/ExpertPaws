<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasPermission
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            $role = $request->user()->getRoleId();
            if ($role === Role::ADMIN || $role === Role::DEVELOPER || $role === Role::MANAGER) {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
    }
}
