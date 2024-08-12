<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Todo;
use App\Infrastructure\Models\Todos;

class TodoRepository
{
    public function create_todo(Todo $todo): Todo
    {
        $todoModel = new Todos;
        $todoObj = $todoModel->create([
            'user_id' => $todo->userID,
            'content' => $todo->content,
        ]);

        $todo->id = $todoObj->id;
        $todo->createdAt = new \DateTime($todoObj->created_at);
        $todo->updatedAt = new \DateTime($todoObj->updated_at);

        return $todo;
    }

    public function get_todos(?int $userID = null): array
    {
        $todoModel = new Todos;

        if ($userID) {
            $todoData = $todoModel->where('user_id', $userID)->get()->toArray();
        } else {
            $todoData = $todoModel->get()->toArray();
        }
        
        $todoList = array();
        foreach ($todoData as $t) {
            $todo = new Todo;
            $todo->id = $t['id'];
            $todo->userID = $t['user_id'];
            $todo->content = $t['content'];
            $todo->createdAt = new \DateTime($t['created_at']);
            $todo->updatedAt = new \DateTime($t['updated_at']);
            $todoList[] = $todo;
        }

        return $todoList;
    }

    public function delete_todo(int $todoID, int $userID): void
    {
        $todoModel = new Todos;
        $todoModel->where('id', $todoID)->where('user_id', $userID)->firstOrFail();
        $todoModel->where('id', $todoID)->where('user_id', $userID)->delete();
    }
}
