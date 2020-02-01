<?php

namespace App\Controller;

use App\Models\TokenModel;
use App\Models\UserModel;
use Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AuthController 
{
    public function getUserWithEmail ( Request $request, Response $response, $args) 
    {
        $user = new UserModel;
        $user = $user->getAll();
        
        $response = $response->withJson($user);

        return $response;
    } 
    public function login ( Request $request, Response $response, $args) 
    {
        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];
        
        $user = new UserModel;
        $user = $user->getUserByEmail($email);
        $getPassword = $user->getPassword();
        
        if(is_null($user))
            return $response->withStatus(401);
        
        if(!password_verify($password, $getPassword))
            return $response->withStatus(401);
            
        $expireDate = (new \DateTime())->modify('+2 days')->format('Y-m-d H:i:s');

        $tokenPayload = [
            'sub' => $user->getId(),
            'name' => $user->getNome(),
            'email' => $user->getEmail(),
            'expired_at' =>  $expireDate
        ];

        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

        $refreshTokenPayload = [
            'email' => $user->getEmail(),
            'ramdom' => uniqid()
        ];
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel->setExpired_at($expireDate)
            ->setRefresh_token($refreshToken)
            ->setToken($token)
            ->setUsuarios_id($user->getId());

        $tokenModel->createToken($tokenModel);

        $response = $response->withJson([
            "token" => $token,
            "refresh_token" => $refreshToken
        ]);
        $response->withAddedHeader('Access-Control-Allow-Origin', 'http://localhost:4200');
        // var_dump($token);
        return $response;
    } 

    public function refreshToken(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $refreshToken = $data['refresh_token'];
        $expireDate = (new \DateTime())->modify('+2 days')->format('Y-m-d H:i:s');

        $refreshTokenDecoded = JWT::decode(
            $refreshToken,
            getenv('JWT_SECRET_KEY'),
            ['HS256']
        );

        $token = new TokenModel();
        $refreshTokenExists = $token->verifyRefreshToken($refreshToken);
        if(!$refreshTokenExists)
            return $response->withStatus(401);
        $user = new UserModel();
        $usuario = $user->getUserByEmail($refreshTokenDecoded->email);
        if(is_null($usuario))
            return $response->withStatus(401);

        $tokenPayload = [
            'sub' => $usuario->getId(),
            'name' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'expired_at' => $expireDate
        ];

        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

        $refreshTokenPayload = [
            'email' => $usuario->getEmail(),
            'ramdom' => uniqid()
        ];
        
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel->setExpired_at($expireDate)
            ->setRefresh_token($refreshToken)
            ->setToken($token)
            ->setUsuarios_id($usuario->getId());

        $tokens = new TokenModel();
        $tokens->createToken($tokenModel);

        $response = $response->withJson([
            "token" => $token,
            "refresh_token" => $refreshToken
        ]);

        return $response;
    }
}