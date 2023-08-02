<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $account = Auth::guard("account")->user();

        switch ($guard) {
            case "account":
                if ($account) {
                    if ($account->role == 'Commerce') {
                        return redirect()->route('commerce');
                    } else if ($account->role == 'Finance') {
                        return redirect()->route('finance-index');
                    } else if ($account->role == 'Admin') {
                        return redirect()->route('admin-index');
                    } else if ($account->role == 'GM') {
                        return redirect()->route('admin.dashboard.peruntukan');
                    }
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('login');
                }
                break;
        }

        return $next($request);
    }
}
