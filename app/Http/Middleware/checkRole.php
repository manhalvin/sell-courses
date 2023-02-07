<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\BaseController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole extends BaseController
{
    /**
     * Kiểm tra vai trò của người truy cập vào website (lọc bộ request của người dùng)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $users = Auth::user();
        if (!Auth::check()) {
            return $this->sendError('You have not logged in yet', []);
        }

        if ($users->role->name != 'Admin') {
            return $this->sendError('You do not have permission to access the admin page', []);
        }
        return $next($request);
    }
}
