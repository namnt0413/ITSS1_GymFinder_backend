<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use PHPUnit\Framework\Constraint\IsEmpty;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function recentGyms()
    {
        $recentGyms = $this->userService->getRecentGyms();
        if ($recentGyms) {
            return response([
                'data' => $recentGyms,
                'message' => 'OK'
            ], 200);
        } else {
            return response([
                'message' => 'Error'
            ], 400);
        }
    }

    public function listGyms()
    {
        $listGyms = $this->userService->getListGyms();
        if ($listGyms) {
            return response([
                'data' => $listGyms,
                'message' => 'OK'
            ], 200);
        } else {
            return response([
                'message' => 'Error'
            ], 400);
        }
    }

    public function filterGyms(Request $request)
    {
        $filterGyms = $this->userService->getFilterGyms($request);

        if ($filterGyms) {
            return response([
                'data' => $filterGyms,
                'message' => 'OK'
            ], 200);
        } else {
            return response([
                'message' => 'Error'
            ], 400);
        }
    }

    public function detailGym($id)
    {
        $gym = $this->userService->getDetailGym($id);
        if ($gym) {
            return response([
                'data' => $gym,
                'message' => 'OK'
            ], 200);
        } else {
            return response([
                'message' => 'Error'
            ], 400);
        }
    }

    public function login(LoginRequest $loginRequest)
    {
        if ($loginRequest->validated()) {
            $user = $this->userService->findByEmail($loginRequest->email);
            if ($user != null) {
                if (strcmp($loginRequest->password, $user->password) == 0) {
                    return response([
                        'data' => $user,
                        'message' => 'Login success'
                    ], 200);
                } else {
                    return response([
                        'message' => 'Password is wrong'
                    ], 400);
                }
            } else {
                return response([
                    'message' => 'User isn\'t exist'
                ], 400);
            }
        }
    }

    public function register()
    {

    }

}
