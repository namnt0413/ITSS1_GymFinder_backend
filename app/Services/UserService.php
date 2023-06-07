<?php
namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function getRecentGyms()
    {
        $recentGyms = User::select('*')->where([ 'status' => 1 ])->where([ 'type' => 2 ])
        ->orderBy('created_at','desc')->limit(5)->with('address','userOption')->get();
        return $recentGyms;
    }

    public function getListGyms()
    {
        $listGyms = User::select('*')->where([ 'status' => 1 ])->where([ 'type' => 2 ])
        ->with('address','userOption')->get();
        return $listGyms;
    }

    public function getFilterGyms($request)
    {
        $queryRaw = "";
        if(sizeof($request->options) !== 0) {
            foreach($request->options as $option)
            {
                $queryRaw == '' ? $queryRaw = $queryRaw . 'user_id IN ( SELECT user_options.user_id from user_options WHERE user_options.option_id = '.$option.' ) '
                            : $queryRaw = $queryRaw . 'and user_id IN ( SELECT user_options.user_id from user_options WHERE user_options.option_id = '.$option.' ) ';
            }
            $filterGyms = User::selectRaw('DISTINCT users.id , users.name , users.status , users.type , users.logo , users.description , users.created_at',)
            ->join('user_options','users.id','=','user_options.user_id')
            ->where([ 'status' => 1 ])->where([ 'type' => 2 ])
            ->where('users.name', 'LIKE', '%' . $request->name . '%')
            ->with('address')
            ->whereRaw($queryRaw)
            ->get();
        }  else {
            $filterGyms = User::selectRaw('DISTINCT users.id , users.name , users.status , users.type , users.logo , users.description , users.created_at',)
            ->join('user_options','users.id','=','user_options.user_id')
            ->where([ 'status' => 1 ])->where([ 'type' => 2 ])
            ->where('users.name', 'LIKE', '%' . $request->name . '%')
            ->with('address')
            ->get();
        }

        return $filterGyms;
    }

    public function getDetailGym($id)
    {
        $gym = User::where(["id" => $id])
        ->with('address','userOption')->get();
        return $gym;
    }

}
