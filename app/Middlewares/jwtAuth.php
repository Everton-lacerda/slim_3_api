<?php

namespace App\Middlewares;

use Tuupola\Middleware\JwtAuthentication;
// use tuupola\Middleware\JwtAuthentication;

function jwtAuth(): JwtAuthentication
{
    return new JwtAuthentication([
        'secret' => getenv('JWT_SECRET_KEY'),
        'attribute' => 'jwt'
    ]);
}
