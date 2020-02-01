<?php

namespace App\Config;

use Exception;

abstract class Model
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        $host = getenv('HOST');
        $port = getenv('PORT');
        $user = getenv('USER');
        $pass = getenv('PASSWORD');
        $dbname = getenv('DBNAME');

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";
        try {
            $this->pdo = new \PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
        } catch (Exception $e) {
            die ($e->getMessage());
        }
    }
}
