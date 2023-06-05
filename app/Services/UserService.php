<?php
namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function getRecentGyms()
    {
        $recentGyms = User::select('*')->where([ 'status' => 1 ])->where([ 'type' => 2 ])
        ->orderBy('created_at','desc')->limit(5)->with('address','option')->get();
        return $recentGyms;
    }

    public function getListGyms()
    {
        $listGyms = User::select('*')->where([ 'status' => 1 ])->where([ 'type' => 2 ])
        ->with('address','option')->get();
        return $listGyms;
    }

    public function getFilterGyms($request)
    {
        $filterGyms = User::selectRaw('DISTINCT users.id , users.name , users.status , users.type , users.logo ,
        users.description, addresses.address , addresses.city')
        ->join('options','users.id','=','options.user_id')->join('addresses','users.id','=','addresses.user_id')
        ->where([ 'status' => 1 ])->where([ 'type' => 2 ])
        ->where('users.name', 'LIKE', '%' . $request->name . '%')->where('options.title', 'LIKE', '%' . $request->option . '%')->get();
        return $filterGyms;
    }

}
