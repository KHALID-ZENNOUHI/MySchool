<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uri = $request->route()->uri;
        $role = session('role_id') ?? '';

        if ($role == 1 || $role == 2) {

            return $next($request);

        }elseif ($role == 3) {

            $teacherRoutes = [
                'teacher/dashboard',
                'absences',
                'absences/create',
                'absences/{absence}',
                'absences/{absence}/edit',
                'activite',
                'activite/create',
                'activite/{activite}',
                'activite/{activite}/edit',
                'classe',
                'classe/{classe}',
                'search-class',
                'etudiants',
                'etudiants/grid',
                'etudiants/{etudiant}',
                'search-student',
                'notes',
                'notes/create',
                'notes/{note}',
                'notes/{note}/edit',
                'cours'
            ];

            if (in_array($uri, $teacherRoutes)) {

                return $next($request);

            }else {

                return abort(401);

            }
        }elseif ($role == 4) {

            $studentRoutes = [
                'student/dashboard',
                'etudiants/grid',
                'etudiants/{etudiant}',
                'search-student',
                'cours',
                'absences',
                'activite',
                'classe',
                'classe/{classe}',
                'search-class',
            ];

            if (in_array($uri, $studentRoutes)) {

                return $next($request);

            }else {

                return abort(401);

            }
        }else {

            return abort(401);

        }

    }
}
