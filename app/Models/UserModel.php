<?php

namespace App\Models;

use App\Config\Model;


class UserModel extends Model
{
    protected $pdo;
        /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nome;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;



    public function __construct()
    {
       parent::__construct();
    }

    public function getUserByEmail(string $email)
    {
        $sql = 'SELECT id, nome, email, password FROM users WHERE email = :email';
        $sql = $this->pdo->prepare($sql);
        $sql->bindParam(':email', $email);
        $sql->execute();
        $users = $sql->fetchAll(\PDO::FETCH_ASSOC);
        // var_dump($user);

            
        if(count($users) == 0 ) {
            return null;
        } 

        $user = new UserModel();

        $user->setId($users[0]['id'])
             ->setNome($users[0]['nome'])
             ->setEmail($users[0]['email'])
             ->setPassword($users[0]['password']);

        return $user;
    }



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return self
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

}