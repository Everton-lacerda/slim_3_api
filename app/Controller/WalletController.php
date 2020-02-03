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
        // $data = $request->getHeaders();
        $queryParams = $request->getQueryParams();
        $id = (int)$queryParams['usuarios_id'];
        $walletsModel = new WalletModel();
        $wallets = $walletsModel->getAllWallets($id);
        $response = $response->withJson($wallets);

        return $response;

        // 
        // $tokenBearer = $data["HTTP_AUTHORIZATION"];
        // $token = explode(" ", $tokenBearer[0] );

        // $refreshTokenDecoded = JWT::decode(
        //     $token[1],
        //     getenv('JWT_SECRET_KEY'),
        //     ['HS256']
        // );

        
        
        // $datos = $getWallets;

        // // print_r($datos[0]['type']);
        // die;

        // $response = $response($getWallets);

        // $response = $response->withJson([
        //     "token" => $getWallets['type'],
        // ]);

        // $response = $getWallets;


        // return $response;
    } 

}