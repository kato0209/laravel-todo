<?php

namespace App\Domain\Entity;

class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;

    public function __construct() {}
}
