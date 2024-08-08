<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../../Application/Usecase/User.php';

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Models\CreateUserInput;
use App\Http\Models\User as UserResponse;
use App\Domain\Entity\User;
use App\Application\Usecase\UserUsecase;


class UserController extends Controller
{
    #[OA\Post(path: '/api/users', tags: ['User'])]
    #[OA\RequestBody(content: [new OA\JsonContent(ref: "#/components/schemas/CreateUserInput")])]
    #[OA\Response(response: Response::HTTP_CREATED, description: 'OK', content: [new OA\JsonContent(ref: "#/components/schemas/User")])]
    public function create_user(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|max:20',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/'
        ]);
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
        $res = new UserResponse($new_user->id, $new_user->email, $new_user->name);

        return response()->json($res);
    }

    #[OA\Get(path: '/api/users', tags: ['User'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK', content: [new OA\JsonContent(ref: "#/components/schemas/User")])]
    public function get_login_user(Request $request)
    {
        $jwt = $request->attributes->get('jwt');
        if (!$jwt) {
            return response()->json(['error' => 'jwt is not found'], 401);
        }
        $userID = $jwt['userID'];
        if (!$userID) {
            return response()->json(['error' => 'userID is not found'], 401);
        }
        $userUsecase = new UserUsecase;
        $user = $userUsecase->get_user_by_id($userID);

        return response()->json($user);
    }
}
