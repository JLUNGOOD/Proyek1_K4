<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        $new_tanggapans = [];
        if (Auth::check()) {
            $pengaduans = auth()->user()->pengaduan()->get();
            foreach ($pengaduans as $i => $pengaduan) {
                $tanggapan = $pengaduan->tanggapan()->latest()->first();
                if ($tanggapan) {
                    if ($tanggapan->is_read == 0) {
                        $new_tanggapans[$i] = $tanggapan;
                    }
                }
            }
        }
        session(['new_tanggapans' => $new_tanggapans]);

        return $next($request);
    }
}
