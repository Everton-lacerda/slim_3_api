<?php

namespace App\Middlewares;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class JwtDateTimeMiddleware
{
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        
        $token = $request->getAttribute('jwt');
        $expireDate = $token['expired_at'];
        $now = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')); 
    
        $dateString = $now->format('Y-m-d H:i:s');
        if($expireDate < $dateString)
            return $response->withStatus(401);

        $response = $next($request, $response);
        return $response;
    }
}
