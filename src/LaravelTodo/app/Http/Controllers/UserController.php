<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../Models/User.php';

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Models\CreateUserInput;
use App\Http\Models\CreateUserOutput;


#[OA\Post(path: '/api/users', tags: ['User'])]
#[OA\RequestBody(content: [new OA\JsonContent(ref: "#/components/schemas/CreateUserInput")])]
#[OA\Response(response: Response::HTTP_CREATED, description: 'OK', content: [new OA\JsonContent(ref: "#/components/schemas/CreateUserOutput")])]
class UserController extends Controller
{
    public function create_user(Request $request)
    {
        $input = new CreateUserInput(
            $request->input('email'),
            $request->input('name'),
            $request->input('password')
        );

        $res = new CreateUserOutput($input->email, $input->name);

        return response()->json($res);
    }
}
