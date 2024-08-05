<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../Models/Todo.php';
require_once __DIR__ . '/../../Application/Usecase/Todo.php';


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Models\CreateTodoInput;
use App\Http\Models\Todo as TodoResponse;
use App\Application\Usecase\TodoUsecase;
use App\Domain\Entity\Todo;


class TodoController extends Controller
{
    #[OA\Post(path: '/api/todos', tags: ['Todo'])]
    #[OA\RequestBody(content: [new OA\JsonContent(ref: "#/components/schemas/CreateTodoInput")])]
    #[OA\Response(response: Response::HTTP_CREATED, description: 'OK', content: [new OA\JsonContent(ref: "#/components/schemas/Todo")])]
    public function create_todo(Request $request)
    {
        $request->validate([
            'userID' => 'required',
            'content' => 'required|max:255',
        ]);
        $input = new CreateTodoInput(
            $request->input('userID'),
            $request->input('content')
        );

        $todo = new Todo;
        $todo->userID = $input->userID;
        $todo->content = $input->content;

        $todoUsecase = new TodoUsecase;
        $new_todo = $todoUsecase->create_todo($todo);

        $res = new TodoResponse($new_todo->id, $new_todo->userID, $new_todo->content, $new_todo->createdAt);

        return response()->json($res);
    }

    #[OA\Get(path: '/api/todos', tags: ['Todo'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK', content: [new OA\JsonContent(type: 'array', items: new OA\Items(ref: "#/components/schemas/Todo"))])]
    public function get_todos(Request $request)
    {
        $todoUsecase = new TodoUsecase;
        $todos = $todoUsecase->get_todos();

        $res = array();
        foreach ($todos as $t) {
            $res[] = new TodoResponse($t->id, $t->userID, $t->content, $t->createdAt);
        }

        return response()->json($res);
    }
}
