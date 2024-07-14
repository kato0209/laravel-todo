<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(title: "Laravel API", version: "1.0")]
#[OA\Server(url: "http://localhost:80")]
abstract class Controller
{
    //
}
