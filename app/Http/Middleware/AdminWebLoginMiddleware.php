<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminWebLoginMiddleware
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
        //    \Artisan::call('logs:clear');
        $storage = Storage::disk('public');
        if ($storage) {
            foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
                $storage->delete($filePathname);
            }
        }


        if (auth('admin-web')->check()) {
            if (auth('admin-web')->user()->isaktif == true) {
                Admin::find(auth('admin-web')->user()->id)->update([
                    'last_seen_at' => now()
                ]);
                return $next($request);
            }else{
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
