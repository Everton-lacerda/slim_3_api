<?php

namespace App\Models;

use App\Config\Model;


class WalletModel extends Model
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $usuarios_id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $date;
    /**
     * @var string
     */
    private $value;
    /**
     * @var float
     */
    private $status;
    /**
     * @var string
     */
    private $description;



    public function __construct()
    {
       parent::__construct();
    }

    public function getAllWallets(string $user_id): array
    {
        $sql = $this->pdo
            ->prepare('SELECT type, date, value, status,description FROM wallets WHERE usuarios_id = :usuarios_id;');
            $sql->bindParam('usuarios_id', $user_id);
            $sql->execute();
            $wallet = $sql->fetchAll(\PDO::FETCH_ASSOC);

        return $wallet;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $Type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return self
     */
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return self
     */
    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }

        /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
