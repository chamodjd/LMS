<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureTeacherOwnsModule
{
    public function handle(Request $request, Closure $next)
    {
        $module = $request->route('module');
        $instructor = Auth::user()->instructor;

        if (!$instructor || $module->instructor_id !== $instructor->id) {
            abort(403, 'You are not assigned to this module.');
        }

        return $next($request);
    }
}
