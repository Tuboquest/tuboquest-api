<?php

namespace App\Http\Middleware;

use App\Models\Disk;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDiskIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $diskToken = $request->bearerToken();

        if ($diskToken) {
            $disk = Disk::where('token', $diskToken)->first();

            if ($disk) {
                $request->attributes->add(['disk' => $disk]);
                return $next($request);
            }
        }

        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }
}
