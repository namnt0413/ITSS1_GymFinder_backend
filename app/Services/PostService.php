<?php
namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;

class PostService
{
    public function getRecentPosts()
    {
        $recentPosts = Post::select('*')->where([ 'status' => 2 ])
        ->orderBy('created_at','desc')->limit(5)->with('user:id,name,logo')->get();
        return $recentPosts;
    }

    public function filterPosts($request)
    {
        $filterPosts = Post::select('*')->where([ 'status' => 2 ])
        ->where('title', 'LIKE', '%' . $request->title . '%')->with('user:id,name,logo')->get();
        return $filterPosts;
    }

}
