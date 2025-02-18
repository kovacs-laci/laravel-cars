<?php

namespace App\Http;

use Symfony\Component\HttpKernel\HttpKernel;

class Kernel extends HttpKernel {
    protected $middlewareGroups = [
        'web' => [
            // Other middleware
            \App\Http\Middleware\SetLocale::class,
        ],
    ];
}

