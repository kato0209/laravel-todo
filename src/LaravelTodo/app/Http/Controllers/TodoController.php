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

        return response()->json($res, 201);
    }

    #[OA\Get(
        path: '/api/todos', 
        tags: ['Todo'], 
        parameters: [
            new OA\Parameter(
                name: 'userID', 
                in: 'query', 
                required: false, 
                schema: new OA\Schema(type: 'integer')
            )
        ]
    )]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK', content: [new OA\JsonContent(type: 'array', items: new OA\Items(ref: "#/components/schemas/Todo"))])]
    public function get_todos(Request $request)
    {
        $jwt = $request->attributes->get('jwt');
        if (!$jwt) {
            return response()->json(['error' => 'jwt is not found'], 401);
        }
        $userID = $request->query('userID');
        
        $todoUsecase = new TodoUsecase;
        $todos = $todoUsecase->get_todos($userID);

        $res = array();
        foreach ($todos as $t) {
            $res[] = new TodoResponse($t->id, $t->userID, $t->content, $t->createdAt);
        }

        return response()->json($res);
    }

    #[OA\Delete(
        path: '/api/todos/{todoID}', 
        tags: ['Todo'], 
        parameters: [
            new OA\Parameter(
                name: 'todoID', 
                in: 'path', 
                required: true, 
                schema: new OA\Schema(type: 'integer')
            )
        ]
    )]
    #[OA\Response(response: "204", description: 'OK')]
    public function delete_todo(Request $request)
    {
        $jwt = $request->attributes->get('jwt');
        if (!$jwt) {
            return response()->json(['error' => 'jwt is not found'], 401);
        }
        $userID = $jwt['userID'];
        if (!$userID) {
            return response()->json(['error' => 'userID is not found'], 401);
        }
        $todoID = $request->route('todoID');
        if (!$todoID) {
            return response()->json(['error' => 'todoID is not found'], 400);
        }

        $todoUsecase = new TodoUsecase;
        $todoUsecase->delete_todo($todoID, $userID);

        return response()->json(null, 204);
    }
}
