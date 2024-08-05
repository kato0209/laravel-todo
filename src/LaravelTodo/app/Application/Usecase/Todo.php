<?php

namespace App\Application\Usecase;

require_once __DIR__ . '/../../Infrastructure/Repository/Todo.php';

use App\Domain\Entity\Todo;
use App\Infrastructure\Repository\TodoRepository;

class TodoUsecase
{
    public function create_todo(Todo $todo): Todo
    {
        $todoRepository = new TodoRepository;
        $todo = $todoRepository->create_todo($todo);

        return $todo;
    }

    public function get_todos(): array
    {
        $todoRepository = new TodoRepository;
        $todos = $todoRepository->get_todos();

        return $todos;
    }
}
