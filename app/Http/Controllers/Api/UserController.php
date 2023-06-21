<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\UserOption;
use App\Models\Address;
use App\Models\User;
use App\Services\UserService;

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

    public function register(RegisterRequest $registerRequest)
    {
        User::create(
            $registerRequest->validated(),
        );
        $createdUser = User::latest()->first();
        Address::create([
            'user_id' => $createdUser->id,
            'city' => "Test",
            'address' => $registerRequest->address,
        ]);

        foreach ($registerRequest->options as $option ) {
            UserOption::create([
                'user_id' => $createdUser->id,
                'option_id' => $option['option_id'],
                'title' => $option['title'],
                'description' => $option['description'],
                'image' => $option['image'],
            ]);
        }
        return response([
            'data' => $createdUser,
            'message' => 'Create new post successfully'
        ], 200);
    }

}
