<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

#[OA\Get(path: '/api/health', tags: ['health'], summary: 'Check the health of the API')]
#[OA\Response(response: Response::HTTP_OK, description: 'OK')]
class HealthController extends Controller
{
    public function index()
    {
        return response()->json([ "health" => "ok"]);
    }
}
