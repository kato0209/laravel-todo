<?php

namespace App\Http\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(schema: "CreateTodoInput", type: "object", required: ['userID', 'content'])]
final class CreateTodoInput
{
    #[OA\Property(type: "integer")]
    public string $userID;

    #[OA\Property(type: "string")]
    public string $content;

    public function __construct(string $userID, string $content)
    {
        $this->userID = $userID;
        $this->content = $content;
    }
}

#[OA\Schema(schema: "Todo", type: "object", required: ['todoID', 'userID', 'content', 'createdAt'])]
final class Todo
{
    #[OA\Property(type: "integer")]
    public int $todoID;

    #[OA\Property(type: "integer")]
    public int $userID;

    #[OA\Property(type: "string")]
    public string $content;

    #[OA\Property(type: "string", format: "date-time")]
    public \DateTime $createdAt;

    public function __construct(int $todoID, string $userID, string $content, \DateTime $createdAt)
    {
        $this->todoID = $todoID;
        $this->userID = $userID;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }
}
