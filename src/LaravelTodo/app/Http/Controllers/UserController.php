<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../../Application/Usecase/User.php';
require_once __DIR__ . '/../../Infrastructure/Repository/User.php';

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Models\CreateUserInput;
use App\Http\Models\CreateUserOutput;
use App\Domain\Entity\User;
use App\Application\Usecase\UserUsecase;


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

        $user = new User;
        $user->email = $input->email;
        $user->name = $input->name;
        $user->password = $input->password;

        $userUsecase = new UserUsecase;

        $new_user = $userUsecase->create_user($user);
        $res = new CreateUserOutput($new_user->id, $new_user->email, $new_user->name);

        return response()->json($res);
    }
}
