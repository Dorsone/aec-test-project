<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function __invoke(): Response
    {
        return response(['message' => 'Hello, World!']);
    }
}
