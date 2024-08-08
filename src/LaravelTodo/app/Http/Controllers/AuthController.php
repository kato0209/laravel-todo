<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../Models/Auth.php';
require_once __DIR__ . '/../../Application/Usecase/Auth.php';

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Models\LoginInput;
use App\Http\Models\User as UserResponse;
use App\Domain\Entity\User;
use App\Application\Usecase\AuthUsecase;


#[OA\Post(path: '/api/login', tags: ['Auth'])]
#[OA\RequestBody(content: [new OA\JsonContent(ref: "#/components/schemas/LoginInput")])]
#[OA\Response(response: Response::HTTP_OK, description: 'OK', content: [new OA\JsonContent(type: 'object', properties: ['jwtToken' => ['type' => 'string']])])]
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/'
        ]);
        $input = new LoginInput(
            $request->input('email'),
            $request->input('password')
        );

        $user = new User;
        $user->email = $input->email;
        $user->password = $input->password;

        $authUsecase = new AuthUsecase;
        $jwtToken = $authUsecase->login($user);
        
        return response()->json([
            'jwtToken' => $jwtToken
        ]);
    }
}
