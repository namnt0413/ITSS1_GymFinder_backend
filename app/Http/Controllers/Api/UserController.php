<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    private $UserService;

    public function __construct( UserService $UserService){
        $this->UserService = $UserService;
    }

    public function all()
    {
        $users = $this->UserService->getAllUsers();
        if ( $users ) {
            return response([
                'data' => $users,
                'message' => 'OK'
            ],200);
        } else {
            return response([
                'message' => 'Error'
            ],400);
        }
    }

}
