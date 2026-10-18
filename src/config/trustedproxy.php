<?php

return [

    /*
    | Comma-separated IPs or CIDR ranges allowed to report the client IP through X-Forwarded-For,
    | i.e. the web front end's server, which calls the API on behalf of the browser.
    | Empty trusts nobody: the client IP is always the direct caller.
    */

    'proxies' => env('TRUSTED_PROXIES') ?: null,

];
