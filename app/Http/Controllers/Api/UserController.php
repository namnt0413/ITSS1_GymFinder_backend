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
    public function recentGyms()
    {
        $recentGyms = $this->UserService->getRecentGyms();
        if ( $recentGyms ) {
            return response([
                'data' => $recentGyms,
                'message' => 'OK'
            ],200);
        } else {
            return response([
                'message' => 'Error'
            ],400);
        }
    }

    public function listGyms()
    {
        $listGyms = $this->UserService->getListGyms();
        if ( $listGyms ) {
            return response([
                'data' => $listGyms,
                'message' => 'OK'
            ],200);
        } else {
            return response([
                'message' => 'Error'
            ],400);
        }
    }

    public function filterGyms(Request $request)
    {
        $filterGyms = $this->UserService->getFilterGyms($request);
        if ( $filterGyms ) {
            return response([
                'data' => $filterGyms,
                'message' => 'OK'
            ],200);
        } else {
            return response([
                'message' => 'Error'
            ],400);
        }
    }

}
