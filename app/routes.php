<?php

use App\Controller\AuthController;
use App\Controller\ProductController;
use App\Controller\WalletController;
use App\Middlewares\JwtDateTimeMiddleware;
use Tuupola\Middleware\JwtAuthentication;
use Tuupola\Middleware\CorsMiddleware;


// use App\Middlewares\JwtDateTimeMiddleware;
// use function App\Middlewares\jwtAuth;

// use tuupola\Middleware\JwtAuthentication;

use function App\config;

$app = new \Slim\App(config());

$app->add(new CorsMiddleware([
    "origin" => ["http://localhost:4200"],
    "methods" => ["GET", "POST", "PATCH", "DELETE", "OPTIONS"],    
    "headers.allow" => ["Origin", "Content-Type", "Authorization", "Accept", "ignoreLoadingBar", "X-Requested-With", "Access-Control-Allow-Origin"],
    "headers.expose" => [],
    "credentials" => true,
    "cache" => 0,        
]));

$app->group('/api', function() use ($app) {
    // $app->get('/auth/login', AuthController::class . ':getUserWithEmail');
    $app->post('/auth/login', AuthController::class . ':login');
    
    $app->post('/auth/refresh', AuthController::class . ':refreshToken');
    
    $app->get('/investors/wallet', WalletController::class . ':getWallet')
        ->add(new JwtDateTimeMiddleware())
        ->add(new JwtAuthentication([
            'secret' => getenv('JWT_SECRET_KEY'),
            'attribute' => 'jwt'
    ]));    
});



$app->run();