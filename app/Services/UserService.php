<?php
namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function getRecentGyms()
    {
        $recentGyms = User::select('*')->where([ 'status' => 1 ])->where([ 'type' => 2 ])
        ->orderBy('created_at','desc')->limit(5)->with('address')->get();
        return $recentGyms;
    }
}
