<?php

return [

    'supported_locales' => [
        'en', 'fr', 'nl'
    ],

    'fallback_locale' => 'en',

    'omitted_locale' => 'en',       // English appears without /en
    'redirect_to_localized_urls' => true, // Redirects users to /fr or /nl automatically

    'redirect_status_code' => 302,

    'detectors' => [
        \CodeZero\LocalizedRoutes\Middleware\Detectors\RouteActionDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\UrlDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\OmittedLocaleDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\UserDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\SessionDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\CookieDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\BrowserDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\AppDetector::class,
    ],

    'stores' => [
        \CodeZero\LocalizedRoutes\Middleware\Stores\SessionStore::class,
        \CodeZero\LocalizedRoutes\Middleware\Stores\CookieStore::class,
        \CodeZero\LocalizedRoutes\Middleware\Stores\AppStore::class,
    ],

];