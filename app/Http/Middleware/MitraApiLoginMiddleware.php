<?php

namespace App\Http\Middleware;

use App\Helpers\Resfor;
use App\Models\MitraUser;
use Closure;
use Illuminate\Http\Request;

class MitraApiLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth('mitra-api')->check()) {
            if (auth('mitra-api')->user()->isaktif == true) {
                MitraUser::find(auth('mitra-api')->user()->id)->update([
                    'last_seen_at' => now()
                ]);
                return $next($request);
            }else{
                return Resfor::error(null, 'Harus login!', 401);
            }
        } else {
            return Resfor::error(null, 'Harus login!', 401);
        }
    }
}
