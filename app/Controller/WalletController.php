<?php

namespace App\Controller;

use App\Models\WalletModel;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

class WalletController 
{
    public function getWallet ( Request $request, Response $response, $args) 
    {
        $data = $request->getHeaders();
        $tokenBearer = $data["HTTP_AUTHORIZATION"];
        $token = explode(" ", $tokenBearer[0] );

        $refreshTokenDecoded = JWT::decode(
            $token[1],
            getenv('JWT_SECRET_KEY'),
            ['HS256']
        );

        $wallets = new WalletModel();
        $getWallets = $wallets->getAllWallets($refreshTokenDecoded->sub);
        print_r($getWallets);

        // $response = $response->withJson($getWallets['type']);

        return $response;
    } 

}