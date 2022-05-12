<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class EnsureUserHasPermission
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->getRoleId() === Role::USER) {
            return redirect('/');
        }

        return $next($request);
    }
}
