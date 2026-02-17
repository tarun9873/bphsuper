<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AntiInspect
{
    public function handle(Request $request, Closure $next)
    {
        /* -------- Block Curl / Wget / Bots -------- */
        $userAgent = strtolower($request->header('User-Agent'));

        $blockedAgents = [
            'curl',
            'wget',
            'python',
            'scrapy',
            'httpclient',
            'libwww',
            'nikto',
            'sqlmap',
            'bot',
            'spider',
            'crawler'
        ];

        foreach ($blockedAgents as $agent) {
            if (strpos($userAgent, $agent) !== false) {
                abort(403, 'Access Denied');
            }
        }

        /* -------- Direct IP Access Block -------- */
        $host = $request->getHost();
        if (filter_var($host, FILTER_VALIDATE_IP)) {
            abort(403, 'Access Denied');
        }

        /* -------- Empty User Agent (Scraper) -------- */
        if (empty($userAgent)) {
            abort(403, 'Access Denied');
        }

        /* -------- Block Postman / API Tools -------- */
        if (str_contains($userAgent, 'postman')) {
            abort(403, 'Access Denied');
        }

        /* -------- Referrer Check (Hotlink protection) -------- */
        $referer = $request->headers->get('referer');
        if ($referer && !str_contains($referer, $host)) {
            abort(403, 'Hotlink Blocked');
        }

        return $next($request);
    }
}