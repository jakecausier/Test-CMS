<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

class ApiContentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function delete(Request $request, Content $content)
    {
        $content->delete();
    }
}
