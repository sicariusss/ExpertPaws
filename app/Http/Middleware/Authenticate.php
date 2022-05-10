<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Redirect;

class Authenticate extends Middleware
{
    /**
     * @param $request
     * @return string|void
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return '/login';
        }
    }
}
