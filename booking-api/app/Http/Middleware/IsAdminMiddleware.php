<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Проверка прав администратора
        if (Gate::denies('isAdmin')) {
            // Если нет прав доступа, то ошибка 403
            abort(403, 'У вас нет прав доступа');
        }

        return $next($request);
    }
}
