<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        if (Auth::user()->role !== $role) {
            if ($role === 'admin') {
                return redirect()->route('client.dashboard')
                    ->with('error', 'Bạn không có quyền truy cập trang quản trị.');
            } else {
                return redirect()->route('auth.login')
                    ->with('error', 'Vui lòng đăng nhập để tiếp tục.');
            }
        }

        return $next($request);
    }
}
