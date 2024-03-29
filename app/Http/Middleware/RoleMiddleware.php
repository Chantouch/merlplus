<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @param  string $role
	 * @return mixed
	 */
	public function handle($request, Closure $next, $role)
	{
		if (!$request->user()->hasRole($role)) {
			return redirect()->route('blog.index')->withErrors(__('auth.not_authorized'));
		}

		return $next($request);
	}
}
