<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the domain
        $domain = $request->getHost();
        switch ($domain) {
            case 'sr.unsinnig.ch':
                app()->setLocale('de');
                break;
            case 'ce.non-sens.ch':
                app()->setLocale('fr');
                break;
            case 'cs.assurdo.ch':
                app()->setLocale('it');
                break;
            default:
                app()->setLocale('de');
                break;
        }
        return $next($request);
    }
}
