<?php

namespace App\Domain\Entity;

class Todo
{
    public int $id;
    public int $userID;
    public string $content;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;

    public function __construct() {}
}
