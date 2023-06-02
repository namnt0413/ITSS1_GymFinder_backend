<?php
namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function getAllUsers()
    {
        $users = User::all();
        return $users;
    }
}
