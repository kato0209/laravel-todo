<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../Models/Todo.php';

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Models\CreateTodoInput;
use App\Http\Models\CreateTodoOutput;


#[OA\Post(path: '/api/todos', tags: ['Todo'])]
#[OA\RequestBody(content: [new OA\JsonContent(ref: "#/components/schemas/CreateTodoInput")])]
#[OA\Response(response: Response::HTTP_CREATED, description: 'OK', content: [new OA\JsonContent(ref: "#/components/schemas/CreateTodoOutput")])]
class TodoController extends Controller
{
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

        return response()->json($input);
    }
}
