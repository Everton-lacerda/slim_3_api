<?php

namespace App;

function config (): \Slim\Container 
{
    $configuration = [
        'settings' => [
            'displayErrorDetails' => getenv('DISPLAY_ERROS_DETAILS'),
        ],
    ];
    return new \Slim\Container($configuration);
}