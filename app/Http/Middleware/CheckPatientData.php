<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPatientData
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        
        if ($user->role === 'patient' && !$user->patient) {
            return redirect()->route('patients.create');
        }

        return $next($request);
    }
}
